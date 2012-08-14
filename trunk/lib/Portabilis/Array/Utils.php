<?php

/**
 * i-Educar - Sistema de gestão escolar
 *
 * Copyright (C) 2006  Prefeitura Municipal de Itajaí
 *                     <ctima@itajai.sc.gov.br>
 *
 * Este programa é software livre; você pode redistribuí-lo e/ou modificá-lo
 * sob os termos da Licença Pública Geral GNU conforme publicada pela Free
 * Software Foundation; tanto a versão 2 da Licença, como (a seu critério)
 * qualquer versão posterior.
 *
 * Este programa é distribuí­do na expectativa de que seja útil, porém, SEM
 * NENHUMA GARANTIA; nem mesmo a garantia implí­cita de COMERCIABILIDADE OU
 * ADEQUAÇÃO A UMA FINALIDADE ESPECÍFICA. Consulte a Licença Pública Geral
 * do GNU para mais detalhes.
 *
 * Você deve ter recebido uma cópia da Licença Pública Geral do GNU junto
 * com este programa; se não, escreva para a Free Software Foundation, Inc., no
 * endereço 59 Temple Street, Suite 330, Boston, MA 02111-1307 USA.
 *
 * @author    Lucas D'Avila <lucasdavila@portabilis.com.br>
 * @category  i-Educar
 * @license   @@license@@
 * @package   Portabilis
 * @since     Arquivo disponível desde a versão 1.1.0
 * @version   $Id$
 */

/**
 * Portabilis_Array_Utils class.
 *
 * @author    Lucas D'Avila <lucasdavila@portabilis.com.br>
 * @category  i-Educar
 * @license   @@license@@
 * @package   Portabilis
 * @since     Classe disponível desde a versão 1.1.0
 * @version   @@package_version@@
 */
class Portabilis_Array_Utils {

  /* Mescla $defaultArray com $array,
    preservando os valores de $array nos casos em que ambos tem a mesma chave. */
  public static function merge($array, $defaultArray) {
    foreach($array as $key => $value) {
      $defaultArray[$key] = $value;
    }

    return $defaultArray;
  }


  /* Mescla os valores de diferentes arrays, onde no array mesclado, cada valor (unico),
     passa a ser a chave do array.
     ex: mergeValues(array(array(1,2), array(2,3,4)) resulta em array(1=>1, 2=>2, 3=>3, 4=>4) */
  public function mergeValues($arrays) {
    if (! is_array($arrays))
      $arrays = array($arrays);

    $merge = array();

    foreach($arrays as $array) {
      foreach($array as $value) {
        if (! in_array($value, $merge))
          $merge[$value] = $value;
      }
    }

    return $merge;
  }


  /* Insere uma chave => valor no inicio do $array,
     preservando os indices inteiros dos arrays (sem reiniciar) */
  public static function insertIn($key, $value, $array) {
    $newArray = array($key => $value);

    foreach($array as $key => $value) {
      $newArray[$key] = $value;
    }

    return $newArray;
  }


  public static function filterSet($arrays, $attrs = array()){
    if (! is_array($arrays))
      $arrays = array($arrays);

    $arraysFiltered = array();

    foreach($arrays as $array)
      $arraysFiltered[] = self::filter($array, $attrs);

    return $arraysFiltered;
  }


  /* Retorna um array {key => value, key => value}
     de atributos filtrados de um outro array, podendo renomear nome dos attrs,
     util para filtrar um array a ser retornado por uma api

       $arrays - array a ser(em) filtrado(s)
       $attrs    - atributo ou array de atributos para filtrar objeto,
       ex: $attrs = array('cod_escola' => 'id', 'nome')
  */
  public static function filter($array, $attrs = array()){
    if (! is_array($attrs))
      $attrs = array($attrs);

    $arrayFiltered = array();

    // apply filter
    foreach($attrs as $attrName => $attrValueName) {
      if (! is_string($attrName))
        $attrName = $attrValueName;

      $arrayFiltered[$attrValueName] = $array[$attrName];
    }

    return $arrayFiltered;
  }

  /* função auxiliar para ser usada com funções de ordenação do php como usort,
     assim basta definir uma função que estenda esta, e passar a usort, ex:

     function sortComponentesCurricularesByNome($componentesCurriculares) {
        function sortByNome($array, $otherArray) {
          return Portabilis_Array_Utils::keySorter('nome', $array, $otherArray);
        }
        
        usort($componentesCurriculares, sortByNome);
        return $componentesCurriculares;
     }
  */  
  public static function keySorter($key, $array, $otherArray) {
    $a = $array['nome'];
    $b = $otherArray['nome'];

    if ($a == $b)
        return 0;

    return ($a < $b) ? -1 : 1;
  }
}
?>
