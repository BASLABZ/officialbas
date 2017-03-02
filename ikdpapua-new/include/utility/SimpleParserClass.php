<?php
class SimpleXmlStreamer extends XmlStreamer{
	public $kodepemda = "";

    public function processNode($xmlString, $elementName, $nodeIndex)
    {
        $xml = simplexml_load_string($xmlString);
        if(strtolower($elementName) == 'kodepemda') $this->kodepemda = str_replace(".", "", $xmlString);

        echo $this->kodepemda."<br>";

        return true;
    }
}
?>