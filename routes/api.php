<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/trips/{trip}/download', 'Api\DownloadTripPackageController')->middleware('auth:api');
/*Route::get('/trips/{trip}/download', 'Api\DownloadTripPackageController');*/

Route::get('/publishlist', function () {
    $trip_list = array(array("trip_id" => 23, "trip_name" => "Block1: Program Kick-Off"), 
                        array("trip_id" => 15, "trip_name" => "Block2: Getting to Work"),
                        array("trip_id" => 29, "trip_name" => "Block3: How Washington Works"),
                        array("trip_id" => 34, "trip_name" => "Block4: Pioneering Innovation"),
                        array("trip_id" => 25, "trip_name" => "Block5: The Power of Pluralism"),
                        array("trip_id" => 39, "trip_name" => "Block6: Northern Study Tours (Iqaluit)"),
                        array("trip_id" => 45, "trip_name" => "Block6: Northern Study Tours (Whitehorse)"),
                        array("trip_id" => 27, "trip_name" => "Block7: Leading in the Global Arena"),
                        array("trip_id" => 28, "trip_name" => "Block8: Leading Into the Next Decade and Closing Ceremony"),
                        array("trip_id" => 40, "trip_name" => "Other Learning Activities")
                        /*array("trip_id" => 25, "trip_name" => "Block5: The Power of Pluralism")*/);
    $json = json_encode($trip_list);
    return $json;
});


Route::get('/publishlistexternal', function () {
    $trip_list = array(array("trip_id" => 41, "trip_name" => "External Advisory Committee"));
    $json = json_encode($trip_list);
    return $json;
});

Route::get('/publishlistadmin', function () {
    $trip_list = array(array("trip_id" => 23, "trip_name" => "Block1: Program Kick-Off"), 
                        array("trip_id" => 15, "trip_name" => "Block2: Getting to Work"),
                        array("trip_id" => 29, "trip_name" => "Block3: How Washington Works"),
                        array("trip_id" => 34, "trip_name" => "Block4: Pioneering Innovation"),
                        array("trip_id" => 25, "trip_name" => "Block5: The Power of Pluralism"),
                        array("trip_id" => 39, "trip_name" => "Block6: Northern Study Tours (Iqaluit)"),
                        array("trip_id" => 45, "trip_name" => "Block6: Northern Study Tours (Whitehorse)"),
                        array("trip_id" => 27, "trip_name" => "Block7: Leading in the Global Arena"),
                        array("trip_id" => 28, "trip_name" => "Block8: Leading Into the Next Decade and Closing Ceremony"),
                        array("trip_id" => 40, "trip_name" => "Other Learning Activities")
                        //array("trip_id" => 1, "trip_name" => "ELDP Demo")
                    );
    $json = json_encode($trip_list);
    return $json;
});

Route::get('/publishlistfrench', function () {
    $trip_list = array(array("trip_id" => 36, "trip_name" => "Bloc 1: Lancement du programme"),
                        array("trip_id" => 19, "trip_name" => "Bloc 2: Se Mettre au travail"),
                        array("trip_id" => 30, "trip_name" => "Bloc 3: Les rouages de Washington"),
                        array("trip_id" => 38, "trip_name" => "Bloc 4: Innovation pionnière"),
                        array("trip_id" => 31, "trip_name" => "Bloc 5: Le pouvoir du pluralisme"),
                        array("trip_id" => 35, "trip_name" => "Bloc 6: Visite d'étude dans le Nord (Iqaluit)"),
                        array("trip_id" => 44, "trip_name" => "Bloc 6: Visite d'étude dans le Nord (Whitehorse)"),
                        array("trip_id" => 32, "trip_name" => "Bloc 7: Le leadership et la mondialisation"),
                        array("trip_id" => 33, "trip_name" => "Bloc 8: Diriger au cours de la prochaine décennie et cérémonie de clôture"),
                        array("trip_id" => 43, "trip_name" => "Autres activités d'apprentissage")
                        /*array("trip_id" => 31, "trip_name" => "Bloc 5: Le pouvoir du pluralisme")*/);
    $json = json_encode($trip_list);
    return $json;
});

Route::get('/publishlistfrenchexternal', function () {
    $trip_list = array(array("trip_id" => 42, "trip_name" => "Comite consultatif externe"));
    $json = json_encode($trip_list);
    return $json;
});

Route::get('/publishlistfrenchadmin', function () {
    $trip_list = array(array("trip_id" => 36, "trip_name" => "Bloc 1: Lancement du programme"),
                        array("trip_id" => 19, "trip_name" => "Bloc 2: Se Mettre au travail"),
                        array("trip_id" => 30, "trip_name" => "Bloc 3: Les rouages de Washington"),
                        array("trip_id" => 38, "trip_name" => "Bloc 4: Innovation pionnière"),
                        array("trip_id" => 31, "trip_name" => "Bloc 5: Le pouvoir du pluralisme"),
                        array("trip_id" => 35, "trip_name" => "Bloc 6: Visite d'étude dans le Nord (Iqaluit)"),
                        array("trip_id" => 44, "trip_name" => "Bloc 6: Visite d'étude dans le Nord (Whitehorse)"),
                        array("trip_id" => 32, "trip_name" => "Bloc 7: Le leadership et la mondialisation"),
                        array("trip_id" => 33, "trip_name" => "Bloc 8: Diriger au cours de la prochaine décennie et cérémonie de clôture"),
                        array("trip_id" => 43, "trip_name" => "Autres activités d'apprentissage")

                    );
    $json = json_encode($trip_list);
    return $json;
});

Route::get('/events/{event}/participants/available', function (\App\Event $event) {
    return $event->available_participants;
});

Route::get('/events/{event}/contacts/available', function (\App\Event $event) {
    return $event->available_contacts;
});

Route::get('/events/{event}/documents/available', function (\App\Event $event) {
    return $event->available_documents;
});

Route::get('/events/{event}/links/available', function (\App\Event $event) {
    return $event->available_links;
});



Route::get('/user', function() {
    return \App\Trip::with('days', 'days.events', 'days.events.documents', 'days.events.people', 'days.events.links', 'articles', 'people')->first();
});


Route::get('/lang/trans.js', function () {

    $trans_file = File::get(base_path('resources/lang/fr.json'));

    $json = json_decode($trans_file);

    $output = [
        'fr' => $json
    ];

    header('Content-Type: text/javascript');
    echo('window.i18n = ' . json_encode($output) . ';');
    exit();
    // return response()->json(json_decode($file));
});