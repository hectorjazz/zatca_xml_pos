<?php
include('../vendor/autoload.php');

// Address country
$country = (new \BaseetApp\UBL\Country())
    ->setIdentificationCode('SA');

// Full address
$address1 = (new \BaseetApp\UBL\Address())
    ->setStreetName('الامير سلطان')
    ->setBuildingNumber(2322)
    ->setPlotIdentification(2223)
    ->setCitySubdivisionName('الرياض')
    ->setCityName('الرياض | Riyadh')
    ->setPostalZone('23333')
    ->setCountry($country);

$legalEt1 = (new \BaseetApp\UBL\LegalEntity())
    ->setRegistrationName('Acme Widget’s LTD');
// Supplier company node
$supplierCompany = (new \BaseetApp\UBL\Party())
    ->setPartyIdentification(
        (new \BaseetApp\UBL\PartyIdentification())
            ->setId("324223432432432")
            ->setSchemeID("CRN")
    )
    // ->setName('Supplier Company Name')
    // ->setPhysicalLocation($address)
    ->setPartyTaxScheme(
        (new \BaseetApp\UBL\PartyTaxScheme)
            ->setCompanyId("311111111101113")
            ->setTaxScheme((new \BaseetApp\UBL\TaxScheme)->setId('VAT'))
    )
    ->setPostalAddress($address1)
    ->setLegalEntity($legalEt1);

// Client contact node
$clientContact = (new \BaseetApp\UBL\Contact())
    // ->setName('Client name')
    ->setElectronicMail('email@client.com')
    ->setTelephone('0032 472 123 456')
    ->setTelefax('0032 9 1234 567');

$legalEt2 = (new \BaseetApp\UBL\LegalEntity())
    ->setRegistrationName('Acme Widget’s LTD 2');

$address2 = (new \BaseetApp\UBL\Address())
    ->setStreetName('الرياض')
    ->setBuildingNumber(1111)
    ->setPlotIdentification(2223)
    ->setCitySubdivisionName('الرياض')
    ->setCityName('الرياض | Dammam')
    ->setPostalZone('12222')
    ->setCountry($country);

// Client company node
$clientCompany = (new \BaseetApp\UBL\Party())
    // ->setPartyIdentification(
    //     (new \BaseetApp\UBL\PartyIdentification())
    //         ->setId("311111112111113")
    //         ->setSchemeID("NAT")
    // )
    // ->setName('My client')
    ->setPostalAddress($address2)
    ->setPartyTaxScheme(
        (new \BaseetApp\UBL\PartyTaxScheme)
            // ->setCompanyId(311111112101113)
            ->setTaxScheme((new \BaseetApp\UBL\TaxScheme)->setId('VAT'))
    )
    // ->setContact($clientContact);
    ->setLegalEntity($legalEt2);

$legalMonetaryTotal = (new \BaseetApp\UBL\LegalMonetaryTotal())
    ->setLineExtensionAmount(14)
    ->setTaxExclusiveAmount(14)
    ->setTaxInclusiveAmount(16.1)
    ->setAllowanceTotalAmount(0)
    ->setPrepaidAmount(0)
    ->setPayableAmount(16.1);

// Tax scheme
$taxScheme = (new \BaseetApp\UBL\TaxScheme())
    ->setId("VAT");

$classifiedTax01 = (new \BaseetApp\UBL\ClassifiedTaxCategory())
->setId("S")
->setPercent(10)
->setTaxScheme($taxScheme);
$classifiedTax02 = (new \BaseetApp\UBL\ClassifiedTaxCategory())
->setId("S")
->setPercent(5)
->setTaxScheme($taxScheme);

// Product
$productItem = (new \BaseetApp\UBL\Item())
    ->setName('قلم رصاص')
    // ->setDescription('Product Description')
    // ->setSellersItemIdentification('SELLERID')
    ->setClassifiedTaxCategoryList(array($classifiedTax01, $classifiedTax02));


$invoiceLineAllowanceCharges = array(
    (new \BaseetApp\UBL\AllowanceCharge)
        ->setChargeIndicator(false)
        ->setAllowanceChargeReason("discount")
        ->setAmount(0)
);

// Price
$price = (new \BaseetApp\UBL\Price())
    // ->setBaseQuantity(1)
    // ->setUnitCode(\BaseetApp\UBL\UnitCode::UNIT)
    ->setAllowanceCharges($invoiceLineAllowanceCharges)
    ->setPriceAmount(2);

// Invoice Line tax totals
$lineTaxTotal = (new \BaseetApp\UBL\TaxTotal())
    ->setTaxAmount(0.6)
    ->setRoundingAmount(4.6);

// InvoicePeriod
$invoicePeriod = (new \BaseetApp\UBL\InvoicePeriod())
    ->setStartDate(new \DateTime());

// Invoice Line(s)
$invoiceLines = [];

$invoiceLines[] = (new \BaseetApp\UBL\InvoiceLine())
    ->setId(1)
    ->setUnitCode("PCE")
    ->setLineExtensionAmount(4)
    ->setItem($productItem)
    // ->setInvoicePeriod($invoicePeriod)
    ->setPrice($price)
    // ->setAccountingCostCode('Product 123')
    ->setTaxTotal($lineTaxTotal)
    ->setInvoicedQuantity(2);

$invoiceLines[] = (new \BaseetApp\UBL\InvoiceLine())
    ->setId(2)
    ->setUnitCode("PCE")
    ->setLineExtensionAmount(10)
    ->setItem(
        (new \BaseetApp\UBL\Item())
        ->setName('قلم رصاص')
        // ->setDescription('Product Description')
        // ->setSellersItemIdentification('SELLERID')
        ->setClassifiedTaxCategoryList(
            array(
                (new \BaseetApp\UBL\ClassifiedTaxCategory())
                ->setId("S")
                ->setPercent(10)
                ->setTaxScheme(
                    (new \BaseetApp\UBL\TaxScheme())
                    ->setId("VAT")
                ),
                (new \BaseetApp\UBL\ClassifiedTaxCategory())
                ->setId("S")
                ->setPercent(5)
                ->setTaxScheme(
                    (new \BaseetApp\UBL\TaxScheme())
                    ->setId("VAT")
                )
            )
        )
    )
    // ->setInvoicePeriod($invoicePeriod)
    ->setPrice(
        (new \BaseetApp\UBL\Price())
        // ->setBaseQuantity(1)
        // ->setUnitCode(\BaseetApp\UBL\UnitCode::UNIT)
        ->setAllowanceCharges(
            array(
                (new \BaseetApp\UBL\AllowanceCharge)
                ->setChargeIndicator(false)
                ->setAllowanceChargeReason("discount")
                ->setAmount(0)
            )
        )
        ->setPriceAmount(5) 
    )
    // ->setAccountingCostCode('Product 123')
    ->setTaxTotal(
        (new \BaseetApp\UBL\TaxTotal())
        ->setTaxAmount(1.5)
        ->setRoundingAmount(11.5)
    )
    ->setInvoicedQuantity(2);

// Total Taxes
$taxCategory01 = (new \BaseetApp\UBL\TaxCategory())
    ->setPercent(10)
    ->setTaxScheme($taxScheme);

$taxSubTotal01 = (new \BaseetApp\UBL\TaxSubTotal())
    ->setTaxableAmount(4+10)
    ->setTaxAmount(0.4+1.0)
    ->setTaxCategory($taxCategory01);

$taxCategory02 = (new \BaseetApp\UBL\TaxCategory())
    ->setPercent(5)
    ->setTaxScheme($taxScheme);

$taxSubTotal02 = (new \BaseetApp\UBL\TaxSubTotal())
    ->setTaxableAmount(4+10)
    ->setTaxAmount(0.2+0.5)
    ->setTaxCategory($taxCategory02);


$taxTotal = (new \BaseetApp\UBL\TaxTotal())
    ->addTaxSubTotal($taxSubTotal01)
    ->addTaxSubTotal($taxSubTotal02)
    ->setTaxAmount(0.6+1.5);


$sign = (new \BaseetApp\UBL\SignatureInformation)
    ->setReferencedSignatureID("urn:oasis:names:specification:ubl:signature:Invoice")
    ->setID('urn:oasis:names:specification:ubl:signature:1');


$ublDecoment = (new \BaseetApp\UBL\UBLDocumentSignatures)
    ->setSignatureInformation($sign);

$extensionContent = (new \BaseetApp\UBL\ExtensionContent)
    ->setUBLDocumentSignatures($ublDecoment);

$UBLExtension[] = (new \BaseetApp\UBL\UBLExtension)
    ->setExtensionURI('urn:oasis:names:specification:ubl:dsig:enveloped:xades')
    ->setExtensionContent($extensionContent);

$UBLExtensions = (new \BaseetApp\UBL\UBLExtensions)
    ->setUBLExtensions($UBLExtension);

$additionalDocumentReference1 = (new \BaseetApp\UBL\AdditionalDocumentReference)
    ->setId('ICV')
    ->setUUID('23');

$additionalDocumentReference2 = (new \BaseetApp\UBL\AdditionalDocumentReference)
    ->setId('PIH')
    ->setAttachment(
        (new \BaseetApp\UBL\Attachment)
            ->setFileContent("NWZlY2ViNjZmZmM4NmYzOGQ5NTI3ODZjNmQ2OTZjNzljMmRiYzIzOWRkNGU5MWI0NjcyOWQ3M2EyN2ZiNTdlOQ==")
    );

// $additionalDocumentReference3 = (new \BaseetApp\UBL\AdditionalDocumentReference)
//     ->setId('QR')
//     ->setAttachment(
//         (new \BaseetApp\UBL\Attachment)
//             ->setFileContent("ARNBY21lIFdpZGdldOKAmXMgTFREAg8zMTExMTExMTExMDExMTMDFDIwMjItMDktMDdUMTI6MjE6MjhaBAQ0LjYwBQMwLjYGLFdJNkdOd3R5NFhyVGMzUDFXclJNMXhsaHF6OVRpbVhkQ0xIOXNnbWowU2c9B2BNRVVDSVFDQ0dMN0FKYWNWT2JzN2x1RllUYnNxS3I5cUxaWCtMWWpaaXZPakRObmFZZ0lnVDBTclpaS2szTDhmelY4L0o3aDlwN3dIMEJvcXBsVzBSQmNXT1ZOZVcwdz0IWDBWMBAGByqGSM49AgEGBSuBBAAKA0IABGGDDKDmhWAITDv7LXqLX2cmr6+qddUkpcLCvWs5rC2O29W/hS4ajAK4Qdnahym6MaijX75Cg3j4aao7ouYXJ9E=")
//     );

$invoiceAllowanceCharges = array(
    (new \BaseetApp\UBL\AllowanceCharge)
        ->setChargeIndicator(false)
        ->setAllowanceChargeReason("discount")
        ->setAmount(0)
        ->setTaxCategoryList(
            array(
                (new \BaseetApp\UBL\TaxCategory)
                ->setId(
                    null,
                    array(
                        'schemeID' => "UN/ECE 5305",
                        'schemeAgencyID' => "6"
                    )
                )
                ->setPercent(10)
                ->setTaxScheme(
                    (new \BaseetApp\UBL\TaxScheme)
                        ->setId("VAT")
                ),
                (new \BaseetApp\UBL\TaxCategory)
                ->setId(
                    null,
                    array(
                        'schemeID' => "UN/ECE 5305",
                        'schemeAgencyID' => "6"
                    )
                )
                ->setPercent(5)
                ->setTaxScheme(
                    (new \BaseetApp\UBL\TaxScheme)
                        ->setId("VAT")
                ),
            )
        )
);

// Invoice object
$invoice = (new \BaseetApp\UBL\Invoice())
    ->setUBLExtensions($UBLExtensions)
    ->setUUID('8d487816-70b8-4ade-a618-9d620b73814a')
    ->setId("SME00023")
    ->setIssueDate(new \DateTime())
    ->setIssueTime((new \DateTime()))
    ->addAdditionalDocumentReference($additionalDocumentReference1)
    ->addAdditionalDocumentReference($additionalDocumentReference2)
    // ->addAdditionalDocumentReference($additionalDocumentReference3)
    ->Signature(new \BaseetApp\UBL\Signature)
    ->setAccountingSupplierParty($supplierCompany)
    ->setAccountingCustomerParty($clientCompany)
    ->setDelivery((new \BaseetApp\UBL\Delivery)->setActualDeliveryDate(new \DateTime()))
    ->setPaymentMeans((new \BaseetApp\UBL\PaymentMeans)->setPaymentMeansCode(10))
    ->setAllowanceCharges(
        $invoiceAllowanceCharges
    )
    // ->setSupplierAssignedAccountID('10001')
    ->setInvoiceLines($invoiceLines)
    ->setLegalMonetaryTotal($legalMonetaryTotal)
    ->setTaxTotal($taxTotal);

$generator = new \BaseetApp\UBL\Generator();
$outputXMLString = $generator->invoice($invoice);

// echo $outputXMLString;
// Create PHP Native DomDocument object, that can be
// used to validate the generate XML
$dom = new \DOMDocument;

// $dom->loadXML(mb_convert_encoding($outputXMLString, 'HTML-ENTITIES', 'UTF-8'));
$dom->loadXML($outputXMLString);
$dom->save('simplified_num.xml');
