<?php

namespace App\Services;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Support\Facades\Storage;

class QrcodeService
{
    private static function createDirectory()
    {
        if (!Storage::disk('public')->exists('qrcodes')) {
            Storage::disk('public')->makeDirectory('qrcodes');
        }
    }

    public static function store($name)
    {
        self::createDirectory();

        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_FPDF,
        ]);
        $qrcode = new QRCode($options);

        $qrcode->render($name, Storage::disk('public')->path("qrcodes/$name.pdf"));
    }

    public static function update($old, $name)
    {
        self::delete($old);
        self::store($name);
    }

    public static function delete($old)
    {
        if (Storage::disk('public')->exists("qrcodes/$old.pdf")) {
            Storage::disk('public')->delete("qrcodes/$old.pdf");
        }
    }
}
