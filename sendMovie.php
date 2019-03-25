<?php
require __DIR__ . '/sender/vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
session_start();

require_once('adminlogin/checksender.php');

if(base64_decode($myTurn)==''/*add your auth username*/){
  //fbase connect
  $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/google-firebase.json');
  $firebase = (new Factory)
      ->withServiceAccount($serviceAccount)
      ->withDatabaseUri(/*Your firebase db url*/)
      ->create();
  $database = $firebase->getDatabase();

    function cwS($divID, $sid, $name, $tur, $boyut, $dil, $afis, $fragman, $konu, $salon, $seans, $fid)
    {
        array_push($_SESSION["justSent"], $divID);
        global $database;
        $newPost = $database
            ->getReference('cwsaloon/' . $sid)
            ->set([
                'aciklama' => $konu,
                'boyut' => $boyut,
                'class' => $tur,
                'dil' => $dil,
                'fragman' => $fragman,
                'id' => $fid,
                'imageUrl' => $afis,
                'name' => $name,
                'salon' => $salon,
                'seans' => $seans
            ]);
        goBack(1);
    }

    function cwC($divID, $sid, $tur, $boyut, $dil, $afis, $fid)
    {
        array_push($_SESSION["justSent"], $divID);
        global $database;
        $newPost = $database
            ->getReference('cwsoon/' . $sid)
            ->set([
                'aciklama' => "",
                'boyut' => $boyut,
                'class' => $tur,
                'dil' => $dil,
                'fragman' => "",
                'id' => $fid,
                'imageUrl' => $afis,
                'name' => "",
                'salon' => "",
                'seans' => ""
            ]);
        goBack(1);
    }

    function srS($divID, $sid, $name, $tur, $boyut, $dil, $afis, $fragman, $konu, $salon, $seans, $fid)
    {
        array_push($_SESSION["justSent"], $divID);
        global $database;
        $newPost = $database
            ->getReference('srsaloon/' . $sid)
            ->set([
                'aciklama' => $konu,
                'boyut' => $boyut,
                'class' => $tur,
                'dil' => $dil,
                'fragman' => $fragman,
                'id' => $fid,
                'imageUrl' => $afis,
                'name' => $name,
                'salon' => $salon,
                'seans' => $seans
            ]);
        goBack(2);
    }

    function srC($divID, $sid, $tur, $boyut, $dil, $afis, $fid)
    {
        array_push($_SESSION["justSent"], $divID);
        global $database;
        $newPost = $database
            ->getReference('srsoon/' . $sid)
            ->set([
                'aciklama' => "",
                'boyut' => $boyut,
                'class' => $tur,
                'dil' => $dil,
                'fragman' => "",
                'id' => $fid,
                'imageUrl' => $afis,
                'name' => "",
                'salon' => "",
                'seans' => ""
            ]);
        goBack(2);
    }

    //change back-color that updated saloons and goback
    function goBack($a)
    {   $_SESSION["sectionSelector"] = $a;
        echo '<script>history.back();</script>';
    }

  if (($_SERVER['REQUEST_METHOD'] == "POST") and (isset($_POST['cwS1submit']) or isset($_POST['cwS2submit']) or isset($_POST['cwS3submit']) or isset($_POST['cwS4submit']) or isset($_POST['cwS5submit']) or isset($_POST['cwS6submit']) or isset($_POST['cwS7submit']))) {
      cwS($_POST['sentDivID'], $_POST['sid'], $_POST['name'], $_POST['tur'], $_POST['boyut'], $_POST['dil'], $_POST['afis'], $_POST['fragman'], $_POST['konu'], $_POST['salon'], $_POST['seans'], $_POST['fid']);
  }

  if (($_SERVER['REQUEST_METHOD'] == "POST") and (isset($_POST['cwC1submit']) or isset($_POST['cwC2submit']) or isset($_POST['cwC3submit']) or isset($_POST['cwC4submit']) or isset($_POST['cwC5submit']))) {
      cwC($_POST['sentDivID'], $_POST['sid'], $_POST['tur'], $_POST['boyut'], $_POST['dil'], $_POST['afis'], $_POST['fid']);
  }

  if (($_SERVER['REQUEST_METHOD'] == "POST") and (isset($_POST['srS1submit']) or isset($_POST['srS2submit']) or isset($_POST['srS3submit']) or isset($_POST['srS4submit']) or isset($_POST['srS5submit']) or isset($_POST['srS6submit']))) {
      srS($_POST['sentDivID'], $_POST['sid'], $_POST['name'], $_POST['tur'], $_POST['boyut'], $_POST['dil'], $_POST['afis'], $_POST['fragman'], $_POST['konu'], $_POST['salon'], $_POST['seans'], $_POST['fid']);
  }

  if (($_SERVER['REQUEST_METHOD'] == "POST") and (isset($_POST['srC1submit']) or isset($_POST['srC2submit']) or isset($_POST['srC3submit']) or isset($_POST['srC4submit']) or isset($_POST['srC5submit']))) {
      srC($_POST['sentDivID'], $_POST['sid'], $_POST['tur'], $_POST['boyut'], $_POST['dil'], $_POST['afis'], $_POST['fid']);
  }
}
