<?php

class AlocarEquipCTRL{

    public function AlocarEquipamento(AlocarEquipamentoVO $vo){

        if($vo->getidEquipamento() == '' || $vo->getidSetor() == ''){
            return 0;
        }
    }


}


