<?php

namespace App\Http\Controllers;

use App\Http\Requests\Report\CloseMovingRequest;
use App\Http\Requests\Report\CreateExpendituresRequest;
use App\Http\Requests\Report\CreateMovingRequest;
use App\Http\Requests\Report\UpdateReserveFundsRequest;
use App\Models\Report;
use App\Models\ReportItem;
use App\Repositories\ReportRepository;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    private $repository;
    private $reportService;

    public function __construct(ReportRepository $reportRepository, ReportService $reportService)
    {
        $this->repository = $reportRepository;
        $this->reportService = $reportService;
    }

    // За конкретний місяць
    public function sectionView(int $year = null, int $month = null, int $user_id = 0)
    {
        $year = year($year);
        $month = month($month);
        $user = user($user_id);

        $report = $this->repository->getOrCreateOrFail($year, $month, $user->id);

        return view('report.display', compact('report', 'user', 'year', 'month'));
    }

    // Всі звіти
    public function sectionUser($id = 0)
    {
        abort_if(user()->id != $id && cannot('report'), 403);

        $user = user($id);

        $reports = $this->repository->getForUser($user->id);

        return view('report.user', compact('reports', 'user'));
    }

    // Створення звіту - Переміщення коштів
    public function sectionMoving()
    {
        return view('report.create.moving');
    }

    // Створення звіту - Резервний фонд
    public function sectionReserveFunds()
    {
        $report = $this->repository->getConcreteOrFail();
        $maxDown = $report->sumToReserve() - $report->sumUnReserve();
        $maxUp = $report->sumOnHands();

        return view('report.reserve_funds', compact('maxUp', 'maxDown'));
    }

    // Створення звіту - Видатки
    public function sectionExpenditures(Request $request)
    {
        $report_id = $request->report;
        return view('report.create.expenditures', compact('report_id'));
    }

    // Створення звіту - Витрати на доставку
    public function sectionShippingCosts()
    {
        return view('report.create.shipping_costs');
    }

    // Створення звіту - Прибуток
    public function sectionProfits(Request $request)
    {
        $report_id = $request->report;
        return view('report.create.profits', compact('report_id'));
    }

    // Оновити резервний фонд
    public function actionReserveFundsUpdate(UpdateReserveFundsRequest $request)
    {
        $report = ReportItem::concrete(year(), month(), user()->id)->firstOrFail();

        if ($request->act == 'put') {
            $nameOperation = 'Переміщення коштів у резерв';
            $type = 'to_reserve';
        } else {
            $nameOperation = 'Переміщення коштів з резерву';
            $type = 'un_reserve';
        }

        Report::create([
            'name_operation' => $nameOperation,
            'sum'            => $request->sum,
            'user_id'        => user()->id,
            'type'           => $type,
            'report_item_id' => $report->id
        ]);

    }

    public function actionCloseMovingForm(Request $request): View
    {
        $report = Report::findOrFail($request->get('id'));

        return view('report.forms.close_moving_form', compact('report'));
    }

    public function actionCloseMoving(CloseMovingRequest $request): void
    {
        $this->reportService->closeMoving($request->get('id'), $request->validated());
    }

    // Створення передачі коштів
    public function actionCreateMoving(CreateMovingRequest $request): void
    {
        $this->reportService->createMoving($request->validated());
    }

    // Видатки
    public function actionCreateExpenditures(CreateExpendituresRequest $request): void
    {
        $this->reportService->createExpenditures($request->all());
    }

    // Витрати на доставку
    public function action_create_shipping_costs($post)
    {
        $this->check($post);

        $array = ['gasoline',
                  'journey',
                  'transport_company',
                  'packing_materials',
                  'for_auto',
                  'salary_courier',
                  'supplies'
        ];
        $data = [];

        foreach ($array as $item) {
            if (!isset($post->$item) || empty($post->$item)) {
                $data[$item] = 0;
            } else {
                $data[$item] = $post->$item;
            }
        }

        $response = [
            'message' => 'Витрати на доставку вдало збережені!',
            'action'  => 'redirect',
            'uri'     => uri('reports', ['section' => 'my'])
        ];

        Reports::createShippingCosts($post, $data);

        response(200, $response);
    }

    // Прибутки
    public function actionCreateProfits(Request $request)
    {
        Report::create([
            'name_operation' => $request->name_operation,
            'sum'            => $request->sum,
            'user_id'        => user()->id,
            'type'           => 'profits',
            'report_item_id' => $request->report_id,
            'comment'        => $request->comment
        ]);
//        $response = [
//            'message' => 'Прибутки вдало збережені!',
//            'action'  => 'redirect',
//            'uri'     => uri('reports', ['section' => 'my'])
//        ];
//
//        return response($response, 200);
    }


    // Превю
    public function action_preview($post)
    {
        $data = ['report' => Reports::getOne($post->id)];
        $this->view->display("reports.preview.{$data['report']->type}", $data);
    }

    // Форма оновлення коментара
    public function action_update_form($post)
    {
        $data = [
            'title'  => 'Редагування звіту',
            'report' => Reports::getOne($post->id, 'reports')
        ];

        $this->view->display('reports.update.index', $data);
    }

    // Оновлення коментара
    public function action_update_comment($post)
    {
        Reports::update(['comment' => $post->comment], $post->id);

        response(200, DATA_SUCCESS_UPDATED);
    }

    public function section_statistics()
    {
        $reports = Reports::findAll('reports', "type IN('shipping_costs','expenditures') AND `user` = ? ORDER BY id DESC", [get('user')]);

        $group_reports = [];

        foreach ($reports as $report) {
            $date = Carbon::parse($report->date);

            if (!isset($group_reports[$date->year]))
                $group_reports[$date->year] = [];

            if (!isset($group_reports[$date->year][$date->month]))
                $group_reports[$date->year][$date->month] = [];

            $data = explode("\n", $report->data);

            foreach ($data as $item) {
                $ex = explode(":", $item);

                if (!isset($group_reports[$date->year][$date->month][$report->type][$ex[0]]))
                    $group_reports[$date->year][$date->month][$report->type][$ex[0]] = 0;

                $group_reports[$date->year][$date->month][$report->type][$ex[0]] += is_numeric($ex[1]) ? $ex[1] : 0;
            }
        }

        $data = [
            'title'       => 'Статистика по звітах',
            'data'        => $group_reports,
            'breadcrumbs' => [
                ['Звіти',
                 uri('reports', ['section' => 'view',
                                 'user'    => get('user')
                 ])
                ],
                ['Статистика по звітах']
            ]
        ];

        $this->view->display('reports.statistics', $data);
    }
}