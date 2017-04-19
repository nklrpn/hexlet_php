<?php

/**
 * ДНК и РНК это последовательности нуклеотидов.
 * Четыре нуклеотида в ДНК это аденин (A), цитозин (C), гуанин (G) и тимин (T).
 * Четыре нуклеотида в РНК это аденин (A), цитозин (C), гуанин (G) и урацил (U).
 *
 * Цепь РНК составляется на основе цепи ДНК последовательной заменой каждого нуклеотида:
 *   G -> C
 *   C -> G
 *   T -> A
 *   A -> U
 * 
 * Напишите функцию toRna, которая принимает на вход цепь ДНК 
 * и возвращает соответствующую цепь РНК (совершает транскрипцию РНК).
 * 
 *   'UGCACCAGAAUU' == toRna('ACGTGGTCTTAA'); 
 */
 
// BEGIN (write your solution here)
function toRna($dna) {
    $dna2rna = array(
        'G' => 'C',
        'C' => 'G',
        'T' => 'A',
        'A' => 'U',
    );
    $rna = '';

    foreach (str_split($dna) as $nucleotide) {
        if (isset($dna2rna[$nucleotide])) {
            $rna .= $dna2rna[$nucleotide];
        }
    }

    return $rna;
}
// END
