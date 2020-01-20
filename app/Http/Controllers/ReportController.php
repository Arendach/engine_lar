<?php

namespace App\Http\Controllers;

use App\Http\Requests\Report\UpdateReserveFundsRequest;
use App\Models\Report;
use App\Models\ReportItem;
use App\Services\ReportService;

class ReportController extends Controller
{
    // За конкретний місяць
    public function sectionView(int $year = null, int $month = null, int $user_id = 0)
    {
        $year = year($year);
        $month = month($month);
        $user = user($user_id);

        $report = app(ReportService::class)
            ->getOrCreateOrFail($year, $month, $user->id)
            ->load('items');

        return view('reports.display', compact('report', 'user', 'year', 'month'));
    }

    // Всі звіти
    public function sectionUser($id = 0)
    {
        abort_if(user()->id != $id && cannot('report'), 403);

        $user = user($id);

        $reports = ReportItem::where('user_id', $user->id)
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get()
            ->mapToGroups(function (ReportItem $item) {
                return [$item->year => $item];
            });

        return view('reports.user', compact('reports', 'user'));
    }

    // Створення звіту - Переміщення коштів
    public function sectionMoving()
    {
        return view('reports.create.moving');
    }

    // Створення звіту - Резервний фонд
    public function sectionReserveFunds()
    {
        $report = ReportItem::concrete(year(), month(), user()->id)->first();

        $maxDown = user()->reserve_funds;
        $maxUp = $report->start_month + $report->just_now;

        return view('reports.reserve_funds', compact('maxUp', 'maxDown'));
    }

    // Створення звіту - Видатки
    public function section_expenditures()
    {
        $data = [
            'title'       => 'Мої звіти :: Видатки',
            'breadcrumbs' => [
                ['Мої звіти', uri('reports', ['section' => 'my'])],
                ['Видатки']
            ]
        ];

        $this->view->display('reports.create.expenditures', $data);
    }

    // Створення звіту - Витрати на доставку
    public function section_shipping_costs()
    {
        $data = [
            'title'       => 'Мої звіти :: Витрати на доставку',
            'breadcrumbs' => [
                ['Мої звіти', uri('reports', ['section' => 'my'])],
                ['Витрати на доставку']
            ]
        ];

        $this->view->display('reports.create.shipping_costs', $data);
    }

    // Створення звіту - Прибуток
    public function section_profits()
    {
        $data = [
            'title'       => 'Мої звіти :: Прибутки',
            'breadcrumbs' => [
                ['Мої звіти', uri('reports', ['section' => 'my'])],
                ['Прибутки (коректування)']
            ]
        ];

        $this->view->display('reports.create.profits', $data);
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

    // Форма підтвердження передачі коштів
    public function action_close_moving_form($post)
    {
        $data = [
            'title'  => 'Отримання коштів',
            'report' => Reports::getOne($post->id)
        ];

        $this->view->display('reports.forms.close_moving_form', $data);
    }

    // Підтвердження передачі коштів
    public function action_success_moving($post)
    {
        if (!isset($post->name_operation) || empty($post->name_operation))
            response(400, 'Введіть назву операції!');

        Reports::successMoving($post);

        response(200, 'Кошти вдало переміщені!');
    }

    // Створення передачі коштів
    public function action_create_moving($post)
    {
        if (!isset($post->user) || empty($post->user))
            response(400, 'Виберіть менеджера!');

        $this->check($post);

        Reports::createMoving($post);

        $login = user($post->user)->login;

        $response = [
            'message' => "Кошти буде передано, як тільки $login підтвердить передачу!",
            'action'  => 'redirect',
            'uri'     => uri('reports', ['section' => 'my'])
        ];

        response(200, $response);
    }

    // Видатки
    public function action_create_expenditures($post)
    {
        $this->check($post);

        $array = ['taxes', 'investment', 'mobile', 'rent', 'social', 'other', 'advert'];
        $data = [];

        foreach ($array as $item) {
            if (!isset($post->$item) || empty($post->$item)) {
                $data[$item] = 0;
            } else {
                $data[$item] = $post->$item;
            }
        }

        Reports::createExpenditures($post, $data);

        $response = [
            'message' => 'Видатки вдало збережені!',
            'action'  => 'redirect',
            'uri'     => uri('reports', ['section' => 'my'])
        ];

        response(200, $response);
    }

    // Витрати на доставку
    public function action_create_shipping_costs($post)
    {
        $this->check($post);

        $array = ['gasoline', 'journey', 'transport_company', 'packing_materials', 'for_auto', 'salary_courier', 'supplies'];
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
    public function action_create_profits($post)
    {
        $this->check($post);

        Reports::createProfits($post);

        $response = [
            'message' => 'Прибутки вдало збережені!',
            'action'  => 'redirect',
            'uri'     => uri('reports', ['section' => 'my'])
        ];

        response(200, $response);
    }


    // Превю
    public function action_preview($post)
    {
        $data = ['report' => Reports::getOne($post->id)];
        $this->view->display("reports.preview.{$data['report']->type}", $data);
    }

    // Валідація форми
    private function check($post)
    {
        if (!isset($post->sum) || empty($post->sum))
            response(400, 'Сума не може бути пустою!');

        if (!isset($post->name_operation) || empty($post->name_operation))
            response(400, 'Введіть назву операції!');
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
                ['Звіти', uri('reports', ['section' => 'view', 'user' => get('user')])],
                ['Статистика по звітах']
            ]
        ];

        $this->view->display('reports.statistics', $data);
    }


    private function authorization($user_id)
    {
        if (!(user()->id == $user_id || can('reports')))
            $this->display_403();
    }
}