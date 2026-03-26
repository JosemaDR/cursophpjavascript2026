<?php
   //DOMDocument. Otro método para cargar un archivo XML es usando DOMDocument.
   //Este método es más complejo pero ofrece más control sobre el proceso de carga y manipulación del XML.

   // $xml = simplexml_load_file("cd_catalog.xml") or die("Error: Cannot create object");
   // foreach($xml->children() as $cd) {
   //    echo $cd->TITLE . "<br>";
   // }

   // Es posible también generar un XML usando PHP.
   //header('Content-Type: text/xml; charset=utf-8');

$xmlDoc = new DOMDocument();
   $xmlDoc->load("cd_catalog.xml");
   $xmlDoc->formatOutput = true; // Para que el XML generado sea legible
   echo $xmlDoc->saveXML();

?>
<!-- <?xml version="1.0" encoding="UTF-8"?>
<CLIENTES>
   <CLIENTE>
      <NOMBRE>Juan</NOMBRE>
      <APELLIDO>Pérez</APELLIDO>
      <EDAD>30</EDAD>
   </CLIENTE>
   <CLIENTE>
      <NOMBRE>Ana</NOMBRE>
      <APELLIDO>García</APELLIDO>
      <EDAD>25</EDAD>
   </CLIENTE>
</CLIENTES> -->