<?php

namespace App\Http\Controllers\MainApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\LogEventMod;
use App\Models\MainApp\Person;
use App\Models\IbanValidation;
use App\Models\OpenSslCrypt;

class PersonTaxSocialDataController extends Controller
{
    public function create($person_id)
    {

        $obj_person = Person::from('persons as p')
            ->where('p.person_id', $person_id)
            ->select('p.person_id')
            ->first();
        $type = 'create';
        return view('MainApp.persons.create_tax_social_data', compact('obj_person', 'type'));
    }

    public function store(Request $request, $person_id)
    {
        //Validate the person post info with the validator of laravel
        $validator = Validator::make($request->all(), [
            'bank_account' => 'required',
            'nss' => 'required',
            'start_date' => 'required|date',
            'observations' => 'nullable'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información de la persona no es correcta, error al crear', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if (!IbanValidation::validate($request->bank_account))
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'Error en validación de IBAN:' . $request->bank_account, 0);
            return back()->withErrors(['error_msg' => 'El número de cuenta introducido es erróneo']);
        }


        if ($person_id <= 0)
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'Se ha intentado acceder a la url de edición con ID erróeno. ID indicado: ' . $person_id, 0);

            return abort(500);
        }

        $obj_ssl = new OpenSslCrypt(SSL_CRYPTO_PUBLIC_KEY, SSL_CRYPTO_PRIVATE_KEY, SSL_CRYPTO_PASSWORD);
        $encrypted = $obj_ssl->encrypt($request->bank_account);
        $hash = sha1($request->bank_account);

        Person::where('person_id', $person_id)
            ->update(
                [
                    'kpqlo' => $encrypted,
                    'hash' => $hash,
                    'nss' => $request->nss,
                    'start_date' => $request->start_date,
                    'observations' => $request->observations
                ]
            );

        return redirect()->route('persons.create_document', $person_id);
    }

    public function edit($person_id)
    {
        //get the obj person with the client_id pased from param

        $obj_person = Person::from('persons as p')
            ->where('p.person_id', $person_id)
            ->select('p.person_id', 'p.kpqlo as bank_account', 'p.nss', 'p.start_date', 'p.observations')
            ->first();


        $obj_ssl = new OpenSslCrypt(SSL_CRYPTO_PUBLIC_KEY, SSL_CRYPTO_PRIVATE_KEY, SSL_CRYPTO_PASSWORD);
        $decrypted = $obj_ssl->decrypt($obj_person->bank_account);
        $obj_person->bank_account = $decrypted;
        $type = 'edit';

        return view('MainApp.persons.edit_tax_social_data', compact('obj_person', 'type'));
    }

    public function update(Request $request, $person_id)
    {
        //Validate the person post info with the validator of laravel
        $validator = Validator::make($request->all(), [
            'bank_account' => 'required',
            'nss' => 'required',
            'start_date' => 'required|date',
            'observations' => 'nullable'
        ]);

        //if validation fails return back with code error
        if ($validator->fails())
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'La información de la persona no es correcta, error al actualizar', 0);

            return back()
                ->withErrors($validator)
                ->withInput();
        }


        if (!IbanValidation::validate(str_replace(' ', '', $request->bank_account)))
        {
            $GLOBALS['obj_log_event']->saveLogEvent(LogEventMod::LOG_EVENT_APPLICATION, 'Error en validación de IBAN:' . $request->bank_account, 0);
            return back()
                ->with('error_msg', 'El número de cuenta introducido es erróneo')
                ->withInput();
        }


        $obj_ssl = new OpenSslCrypt(SSL_CRYPTO_PUBLIC_KEY, SSL_CRYPTO_PRIVATE_KEY, SSL_CRYPTO_PASSWORD);
        $encrypted = $obj_ssl->encrypt($request->bank_account);

        $hash = sha1($request->bank_account);

        Person::where('person_id', $person_id)
            ->update(
                [
                    'kpqlo' => $encrypted,
                    'hash' => $hash,
                    'nss' => $request->nss,
                    'start_date' => $request->start_date,
                    'observations' => $request->observations
                ]
            );


        return redirect()->route('persons.edit_tax_social_data', $person_id)->with('success_msg', 'Se ha actualizado la información correctamente');;
    }
}
