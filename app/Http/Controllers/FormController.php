<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InspectedString;

class FormController extends Controller
{
    public function view(Request $request)
    {
        $isInspected = session()->has('text') ? 'isInspected' : '';
        $text = session()->pull('text');
        $language = session()->pull('language');

        $history = InspectedString::all();
        

        return view('form', compact('text', 'language','isInspected','history'));
    }

    public function inspect(Request $request)
    {
        $reRus = '/[а-яА-Я]/u';
        $reEng = '/[a-zA-Z]/';   


        $inputText = $request->input()['text'];


        session(['text' => $inputText]);
        preg_match_all($reEng, $inputText, $matchesEng);
        preg_match_all($reRus, $inputText, $matchesRus);

        $currentLanguage = count($matchesRus[0]) >= count($matchesEng[0]) ? 'rus' : 'eng';
        session(['language' => $currentLanguage]);

        $reInspectFor = $currentLanguage == 'eng' ? $reRus : $reEng;

        $result = preg_replace_callback($reInspectFor, function ($match) {
            return '<span class="highlight">' . $match[0] . "</span>";
        }, $inputText);

        session(['text' => $result]);

        $inspectedString = new InspectedString();
        $inspectedString->text = $result;
        $inspectedString->language = $currentLanguage;
        $inspectedString->save();

        return back();
    }
}
