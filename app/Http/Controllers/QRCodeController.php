<?php

namespace App\Http\Controllers;

use App\Models\User;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Inertia\Inertia;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
  /**
   * 
   * this function is used to generate qr code for user name and email using qi io libarry
   */
  public function index()
  {

    $user = User::all();

    $users = $user->map(function ($user) {

      $name_qr = QrCode::format('png')
                ->size(200)
                ->color(0, 0, 255)
                ->generate($user->name);

      $email_qr = QrCode::format('png')
                  ->size(200)
                  ->color(255, 0,0)
                  ->generate($user->email);
      $name_email_qrs = QrCode::format('png')
                        ->size(200)
                        ->generate( '123456789' . '-' . $user->email);
      
      $name_qr_data_url = 'data:image/png;base64,' . base64_encode(string: $name_qr);
      $email_qr_data_url = 'data:image/png;base64,' . base64_encode($email_qr);
      $name_email_qr = 'data:image/png;base64,'. base64_encode($name_email_qrs);
        
      return [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'name_qr' => $name_qr_data_url,
        'email_qr' => $email_qr_data_url,
        'name_email_qr' => $name_email_qr
      ];
    });

    return Inertia::render('QRCode/Index', [
      'users' => $users,
    ]);
  }


  // /**
  //  *  this function is used to generate qr code for user name and email using google libray
  //  * @return \Inertia\Response
  //  */
  // public function index()
  //   {
  //       $users = User::all()->map(function ($user) {
           
  //           $name_qr_url = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($user->name);
  //           $email_qr_url = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($user->email);

  //           return [
  //               'id' => $user->id,
  //               'name' => $user->name,
  //               'email' => $user->email,
  //               'name_qr' => $name_qr_url,
  //               'email_qr' => $email_qr_url,
  //           ];
  //       });

  //       return Inertia::render('QRCode/Index', [
  //           'users' => $users,
  //       ]);
  //   }

  // public function index()
  //   {
  //       $users = User::all()->map(function ($user) {
           
  //           $name_qr_url = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($user->name);
  //           $email_qr_url = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($user->email);

  //           return [
  //               'id' => $user->id,
  //               'name' => $user->name,
  //               'email' => $user->email,
  //               'name_qr' => $name_qr_url,
  //               'email_qr' => $email_qr_url,
  //           ];
  //       });

  //       return Inertia::render('QRCode/Index', [
  //           'users' => $users,
  //       ]);
  //   }
}

