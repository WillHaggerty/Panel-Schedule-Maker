<?php

namespace App\Services;

class CircuitService {

  public function skipCircuits($panelCircuits, $panel) {
    $skipCircuits = [];
    foreach ($panelCircuits as $panelCircuit) {
      if ($panel['ab'] == 1 && $panelCircuit['ab'] == 0) {
        if ($panelCircuit->poles == 2) {
          $cct = $panelCircuit->circuit_num + 2;
          $skipCircuits[$cct] = 1;
          $cct = $panelCircuit->circuit_num + 4;
          $skipCircuits[$cct] = 1;
          $cct = $panelCircuit->circuit_num + 6;
          $skipCircuits[$cct] = 1;
        } elseif ($panelCircuit->poles == 3) {
          $cct = $panelCircuit->circuit_num + 2;
          $skipCircuits[$cct] = 1;
          $cct = $panelCircuit->circuit_num + 4;
          $skipCircuits[$cct] = 1;
          $cct = $panelCircuit->circuit_num + 6;
          $skipCircuits[$cct] = 1;
          $cct = $panelCircuit->circuit_num + 8;
          $skipCircuits[$cct] = 1;
          $cct = $panelCircuit->circuit_num + 10;
          $skipCircuits[$cct] = 1;
        }
      } else {
        if ($panelCircuit->poles == 2) {
          $cct = $panelCircuit->circuit_num + 2;
          $skipCircuits[$cct] = 1;
        } elseif ($panelCircuit->poles == 3) {
          $cct = $panelCircuit->circuit_num + 2;
          $skipCircuits[$cct] = 1;
          $cct = $panelCircuit->circuit_num + 4;
          $skipCircuits[$cct] = 1;
        }
      }
    };
    return $skipCircuits;
  }

}
