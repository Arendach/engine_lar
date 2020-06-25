<?php

use Illuminate\Database\Seeder;
use App\Models\OrderFile;

class OrderFilesSeeder extends Seeder
{
    public function run()
    {
        DB::connection('old')->table('order_images')->get()->each(function (stdClass $item) {
            $path = $this->getNewPath($item->path);

            OrderFile::create([
                'path'     => $path,
                'order_id' => $item->order_id,
                'name'     => $this->getFileName($item->path),
                'user_id'  => 1
            ]);
        });

        $this->deleteOldFiles();

    }

    private function getNewPath(string $path): string
    {
        $newPath = str_replace('/server/uploads/', '/storage/', $path);

        return $newPath;
    }

    private function getFileName(string $path): string
    {
        $pathInfo = pathinfo($path);

        return $pathInfo['basename'];
    }

    private function deleteOldFiles()
    {
        $files = scandir(public_path('storage/orders'));

        unset($files[0], $files[1]);

        foreach ($files as $file) {
            $path = "/storage/orders/$file";

            if (!OrderFile::where('path', $path)->count()) {
                if (is_file(public_path($path))) {
                    unlink(public_path($path));
                }
            }
        }
    }
}
