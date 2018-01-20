<?php

    function validForm( $name, $surname, $age, $address )
    {

      $stringPattern = "/^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ ]*$/";

      if(  $name != null && $name != "" )
      {
        if( !preg_match($stringPattern, $name) )
          {
            $GLOBALS['notyfication'] = "Imię i nazwisko może składać się wyłącznie z liter ";
            return false;
          }
        if(  $surname != null && $surname != "" )
        {
          if( !preg_match($stringPattern, $surname) )
            {
              $GLOBALS['notyfication'] = "Imię i nazwisko może składać się wyłącznie z liter ";
              return false;
            }

            if(  $age != null && $age != "" )
            {
              if($age > 0)
              {
                if($age < 18)
                {
                  if(   $address != null && $address != "" )
                  {
                    if( !preg_match($stringPattern, $address) )
                      {
                        $GLOBALS['notyfication'] = " Adres powinien składać się z Liter ";
                        return false;
                      }
                    $GLOBALS['notyfication'] = "Dane dodane poprawnie";
                    return true;
                 }
                }
                else
                {
                  $GLOBALS['notyfication'] = "Za stary na prezent";
                  return false;
                }
              }
              else
              {
                $GLOBALS['notyfication'] = "Wiek musi być dodatni";
                return false;
              }
            }
          }
        }
        $GLOBALS['notyfication'] = "Żadne pole nie może być puste";
        return false;
    }

?>
