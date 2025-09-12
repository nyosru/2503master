<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class QrCodeService extends Controller
{
    public function generateQrCode(string $content, int $size = 200): string
    {
        $options = new QROptions([
            'version' => 5,
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel' => QRCode::ECC_L,
            'scale' => 5,
            'imageBase64' => true,
            'imageTransparent' => false,
        ]);

        $qrcode = new QRCode($options);

        // Генерируем QR код и возвращаем base64
//        $qrImage = $qrcode->render($content);
        return $qrcode->render($content);

//                return 'data:image/png;base64,' . base64_encode($qrImage);
    }

    // Альтернативный метод для прямого получения бинарных данных
    public function generateQrCodeBinary(string $content): string
    {
        $options = new QROptions([
            'version' => 5,
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel' => QRCode::ECC_L,
            'scale' => 5,
            'imageBase64' => false, // ← false для бинарных данных
            'imageTransparent' => false,
        ]);

        $qrcode = new QRCode($options);

        return $qrcode->render($content);
    }

}
