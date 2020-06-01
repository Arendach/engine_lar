<?php

use Illuminate\Database\Seeder;
use App\Models\OrderFile;

class OrderFilesSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('order_images')->get()->each(function (stdClass $item) {
            OrderFile::create([
                'path'     => $this->getNewPath($item->path),
                'order_id' => $item->order_id
            ]);
        });
    }

    private function getNewPath(string $path): string
    {
        $newPath = str_replace('/server/uploads/', '/storage/', $path);

        return $newPath;
    }

    private function getFileName(string $path): string
    {
        $pathInfo = pathinfo($path);

        dd($pathInfo);
        return pathinfo($path)['basename'];
    }
}
