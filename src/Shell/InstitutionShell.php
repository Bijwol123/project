<?php
namespace App\Shell;
use Cake\Console\Shell;

class InstitutionShell extends Shell
{
    public function initialize(){
        parent::initialize();
        $this->loadModel('Institution');
    }
    public function test()
    {
      $page=1;
        while(True){
              $string = file_get_contents("http://HPGEZFEQCUA96W34905U@data.unistats.ac.uk/api/v4/KIS/Institutions.Json?pageIndex=$page&pageSize=5");
              $string=trim($string);
              if($string=="[]"){
                  break;
              }
              $json = json_decode($string);
              $count=0;
              $total=0;
              $notInserted=[];
            //$this->out($string);die();
            foreach($json as $value){
                //$this->out($value);die();
                $this->out(serialize($value));
                $institution = $this->Institution->newEntity();
                $institution->APROutcome = $value->APROutcome;
                $institution->ApiUrl = $value->ApiUrl;
                $institution->Country = $value->Country;
                $institution->Name = $value->Name;
                $institution->NumberOfCourses = $value->NumberOfCourses;
                $institution->PUBUKPRN = $value->PUBUKPRN;
                $institution->PUBUKPRNCountry = $value->PUBUKPRNCountry;
                $institution->QAAReportUrl = $value->QAAReportUrl;
                $institution->SortableName = $value->SortableName;
                $institution->StudentUnionUrl = $value->StudentUnionUrl;
                $institution->StudentUnionUrlWales = $value->StudentUnionUrlWales;
                $institution->TEFOutcome = $value->TEFOutcome;
                $institution->UKPRN = $value->UKPRN;
                if($this->Institution->save($institution)){
                    $count++;
                  }else{
                      $notInserted[]=serialize($value);
                  }
                  $total++;
                }
              }
              $this->out("Total row: ".$total." Inserted row: ".$count." Not Inserted: ".count($notInserted));
              if(count($notInserted)>0){
                 file_put_contents('log', $notInserted);
              }
          $page++;
        }
    public function jsonTest()
    {
      $page=1;
    
          $string = file_get_contents("http://HPGEZFEQCUA96W34905U@data.unistats.ac.uk/api/v4/KIS/Institutions.Json?pageSize=2000");
          $string=trim($string);
          // if($string=="[]"){
          //     break;
          // }
          $json = json_decode($string);
          $count=0;
          $total=0;
          $notInserted=[];
        //$this->out($string);die();
        foreach($json as $value){
            //$this->out($value);die();
            $this->out(serialize($value));
            $institution = $this->Institution->newEntity();
            $institution->APROutcome = $value->APROutcome;
            $institution->ApiUrl = $value->ApiUrl;
            $institution->Country = $value->Country;
            $institution->Name = $value->Name;
            $institution->NumberOfCourses = $value->NumberOfCourses;
            $institution->PUBUKPRN = $value->PUBUKPRN;
            $institution->PUBUKPRNCountry = $value->PUBUKPRNCountry;
            $institution->QAAReportUrl = $value->QAAReportUrl;
            $institution->SortableName = $value->SortableName;
            $institution->StudentUnionUrl = $value->StudentUnionUrl;
            $institution->StudentUnionUrlWales = $value->StudentUnionUrlWales;
            $institution->TEFOutcome = $value->TEFOutcome;
            $institution->UKPRN = $value->UKPRN;
            if($this->Institution->save($institution)){
                $count++;
              }else{
                  $notInserted[]=serialize($value);
              }
              $total++;
          }
          
          $this->out("Total row: ".$total." Inserted row: ".$count." Not Inserted: ".count($notInserted));
          if(count($notInserted)>0){
             file_put_contents('log', $notInserted);
          }
    }
}

?>