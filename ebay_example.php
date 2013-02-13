<?php
/**
 * Example of encoding an XML file and decoding
 */
$shopserviceoptions ='<ShippingServiceOptions><ShippingServiceOption><ShippingService>10102</ShippingService><ShippingServicePriority>1</ShippingServicePriority><FreeShipping>0</FreeShipping><ShippingServiceCost>5,00</ShippingServiceCost><ShippingServiceAdditionalCost>5,00</ShippingServiceAdditionalCost><ShippingServiceAddSurcharge></ShippingServiceAddSurcharge><ShippingServiceSurchargeVal></ShippingServiceSurchargeVal></ShippingServiceOption></ShippingServiceOptions>';
$ebay = new Ebay();
$code = $ebay->encode($shopserviceoptions);
echo $code;
$xml = $ebay->decode($code);
echo $xml;