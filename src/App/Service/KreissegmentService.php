<?php

declare(strict_types=1);

namespace App\Service;

class KreissegmentService
{
    private $radius;
    private $winkelGrad;
    private $sehnenlaenge;
    private $hoehe;

    public function __construct(
        $radius,
        $winkelGrad,
        $sehnenlaenge,
        $hoehe
    ) {
        $this->radius = $radius;
        $this->winkelGrad = $winkelGrad;
        $this->sehnenlaenge = $sehnenlaenge;
        $this->hoehe = $hoehe;
    }

    public function berechneKreissegment()
    {
        $ergebnis = [];

        // Bestimme den Winkel basierend auf den gegebenen Parametern
        if ($this->winkelGrad !== null) {
            // Winkel ist gegeben
            $winkel = $this->winkelGrad;
        } elseif ($this->sehnenlaenge !== null) {
            // Winkel aus Sehnenlänge berechnen
            $winkel = 2 * rad2deg(asin($this->sehnenlaenge / (2 * $this->radius)));
        } elseif ($this->hoehe !== null) {
            // Winkel aus Höhe berechnen
            $winkel = 2 * rad2deg(acos(($this->radius - $this->hoehe) / $this->radius));
        } else {
            return "Fehler: Mindestens ein Parameter (Winkel, Sehnenlänge oder Höhe) muss angegeben werden!";
        }

        // Winkel in Radiant umrechnen
        $winkelRad = deg2rad($winkel);

        // Alle Werte berechnen
        $ergebnis['radius'] = $this->radius;
        $ergebnis['winkelGrad'] = round($winkel, 2);
        $ergebnis['winkelRad'] = round($winkelRad, 4);

        // Sehnenlänge
        $ergebnis['sehnenlaenge'] = round(2 * $this->radius * sin($winkelRad / 2), 2);

        // Höhe des Segments (Stich)
        $ergebnis['hoehe'] = round($this->radius * (1 - cos($winkelRad / 2)), 2);

        // Bogenlänge
        $ergebnis['bogenlaenge'] = round($this->radius * $winkelRad, 2);

        // Fläche des Kreissegments
        $ergebnis['flaecheSegment'] = round(($this->radius * $this->radius / 2) * ($winkelRad - sin($winkelRad)), 2);

        // Fläche des Kreissektors
        $ergebnis['flaecheSektor'] = round(($this->radius * $this->radius * $winkelRad) / 2, 2);

        // Fläche des Dreiecks
        $ergebnis['flaecheDreieck'] = round(($this->radius * $this->radius * sin($winkelRad)) / 2, 2);

        // Umfang des Segments
        $ergebnis['umfang'] = round($ergebnis['bogenlaenge'] + $ergebnis['sehnenlaenge'], 2);

        return $ergebnis;
    }

    public function berechneKreissegment2()
    {
        $ergebnis = [];

        // Bestimme den Winkel basierend auf den gegebenen Parametern
        if ($this->winkelGrad !== null) {
            // Winkel ist gegeben
            $winkel = $this->winkelGrad;
        } elseif ($this->sehnenlaenge !== null) {
            // Winkel aus Sehnenlänge berechnen
            $winkel = 2 * rad2deg(asin($this->sehnenlaenge / (2 * $this->radius)));
        } elseif ($this->hoehe !== null) {
            // Winkel aus Höhe berechnen
            $winkel = 2 * rad2deg(acos(($this->radius - $this->hoehe) / $this->radius));
        } else {
            return "Fehler: Mindestens ein Parameter (Winkel, Sehnenlänge oder Höhe) muss angegeben werden!";
        }

        // Winkel in Radiant umrechnen
        $winkelRad = deg2rad($winkel);

        // Alle Werte berechnen
        $ergebnis['radius'] = $this->radius;
        $ergebnis['winkelGrad'] = round($winkel, 2);
        $ergebnis['winkelRad'] = round($winkelRad, 4);

        // Sehnenlänge
        $ergebnis['sehnenlaenge'] = round(2 * $this->radius * sin($winkelRad / 2), 2);

        // Höhe des Segments (Stich)
        $ergebnis['hoehe'] = round($this->radius * (1 - cos($winkelRad / 2)), 2);

        // Bogenlänge
        $ergebnis['bogenlaenge'] = round($this->radius * $winkelRad, 2);

        // Fläche des Kreissegments
        $ergebnis['flaecheSegment'] = round(($this->radius * $this->radius / 2) * ($winkelRad - sin($winkelRad)), 2);

        // Fläche des Kreissektors
        $ergebnis['flaecheSektor'] = round(($this->radius * $this->radius * $winkelRad) / 2, 2);

        // Fläche des Dreiecks
        $ergebnis['flaecheDreieck'] = round(($this->radius * $this->radius * sin($winkelRad)) / 2, 2);

        // Umfang des Segments
        $ergebnis['umfang'] = round($ergebnis['bogenlaenge'] + $ergebnis['sehnenlaenge'], 2);

        return $ergebnis;
    }
}
