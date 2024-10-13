<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\Storage;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::disk('public')->deleteDirectory('users');

        $students = [];

        for ($i=0; $i < 100; $i++) {
            $nationalityId = fake()->numerify('##############');

            $renderer = new ImageRenderer(
                new RendererStyle(400),
                new ImagickImageBackEnd()
            );
            $writer = new Writer($renderer);

            $tempFile = tempnam(sys_get_temp_dir(), 'qrcode');
            $writer->writeFile('hello world', $tempFile);

            $path = '/storage/' . Storage::disk('public')->putFile('users', $tempFile);

            unlink($tempFile);

            array_push($students, [
                'id' => (string) Str::orderedUuid(),
                'name' => fake()->name(),
                'nationality_id' => $nationalityId,
                'qr-code' =>  $path
            ]);
        }

        Student::query()->insert($students);
    }
}
