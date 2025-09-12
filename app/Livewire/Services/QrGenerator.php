<?php

namespace App\Livewire\Services;

use App\Http\Controllers\Services\QrCodeService;
use Livewire\Component;

use Livewire\Attributes\Validate;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\GdImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class QrGenerator extends Component
{

    #[Validate('required|min:3')]
    public string $content = '';

    public string $qrCode = '';

    public function generateQrCode()
    {
        $this->validate();

////        // Генерация QR кода в base64
//        $this->qrCode = QrCode::format('png')
//            ->size(200)
//            ->generate($this->content);

//
//        // Используем GD вместо Imagick
//        $renderer = new ImageRenderer(
//            new RendererStyle(200), // размер
//            new GdImageBackEnd()    // используем GD
//        );
//
//        $writer = new Writer($renderer);
//        $qrCode = $writer->writeString($this->content);
//
//        $this->qrCode = base64_encode($qrCode);

        $qrService = new QrCodeService();
        $this->qrCode = $qrService->generateQrCode($this->content, 200);

        // Для скачивания используем бинарные данные
//        $binaryData = $qrService->generateQrCodeBinary($this->content);
////        $this->downloadUrl = 'data:image/png;base64,' . base64_encode($binaryData);
//        $this->qrCode = 'data:image/png;base64,' . base64_encode($binaryData);

    }


    public function render()
    {
        return view('livewire.services.qr-generator');
    }
}
