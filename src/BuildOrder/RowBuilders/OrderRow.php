<?php
namespace Svea;

class OrderRow {

    /**
     * Optional
     * @param string $articleNumberAsString
     * @return $this
     */
    public function setArticleNumber($articleNumberAsString) {
        $this->articleNumber = $articleNumberAsString;
        return $this;
    }
    /** @var string $articlenumber  Optional. */
    public $articleNumber;
    
    /**
     * Required. Quantity expressed as numeric value. 
     * 
     * The integration package supports fractions input at any precision, but 
     * when sending the request to Svea numbers are rounded to two decimal places.
     * 
     * @param numeric $quantityAsFloat
     * @return $this
     */
    public function setQuantity($quantityAsNumeric) {
        $this->quantity = $quantityAsNumeric;
        return $this;
    }
    /** @var float $quantity  */
    public $quantity;
    
    /**
     * Optional
     * 
     * The unit name, i.e. "pieces", "pcs.", "st.", "mb" et al. 
     * 
     * @param string $unitAsString
     * @return $this
     */
    public function setUnit($unitAsString) {
        $this->unit = $unitAsString;
        return $this;
    }
    /**@var string */
    public $unit;

    /**
     * Precisely two of these values must be set in the WebPayItem object:  AmountExVat, AmountIncVat or VatPercent for Orderrow. 
     * Use functions setAmountExVat(), setAmountIncVat() or setVatPercent().
     * 
     * Order row item price excluding taxes, expressed as a float value. 
     *  
     * The integration package supports fractions input at any precision, but 
     * when sending the request Svea numbers are rounded to two decimal places.
     * 
     * @param float $AmountAsFloat
     * @return $this
     */
    public function setAmountExVat($AmountAsFloat) {
        $this->amountExVat = $AmountAsFloat;
        return $this;
    }
    /** @var float $amountExVat */
    public $amountExVat;
    
    /**
     * Precisely two of these values must be set in the WebPayItem object:  AmountExVat, AmountIncVat or VatPercent for Orderrow. 
     * Use functions setAmountExVat(), setAmountIncVat() or setVatPercent().
     * 
     * Order row item price including tax, expressed as a float value. 
     *  
     * The integration package supports fractions input at any precision, but 
     * when sending the request Svea numbers are rounded to two decimal places.
     * 
     * Note:
     * If you specify AmountIncVat, note that this may introduce a cumulative rounding error when ordering large
     * quantities of an item, as the package bases the total order sum on a calculated price ex. vat.
     * 
     * We recommend specifying AmountExVat and VatPercentage.
     * 
     * Also, Svea uses bankers rounding (half-to-even) when calculating the order total, so at times a rounding error of at most
     * one cent/öre may show up if the implementation/shop does not use the same rounding method.
     * 
     * See HostedPaymentTest for examples, including sums and calculations.
     * 
     * @param float $AmountAsFloat
     * @return $this
     */
    public function setAmountIncVat($AmountAsFloat) {
        $this->amountIncVat = $AmountAsFloat;
        return $this;
    }    
    /** @var float $amountIncVat */
    public $amountIncVat;
    
    /**
     * Precisely two of these values must be set in the WebPayItem object:  AmountExVat, AmountIncVat or VatPercent for Orderrow. 
     * Use functions setAmountExVat(), setAmountIncVat() or setVatPercent().
     * 
     * @param int $vatPercentAsInt
     * @return $this
     */
    public function setVatPercent($vatPercentAsInt) {
        $this->vatPercent = $vatPercentAsInt;
        return $this;
    }
    /** @var int $vatPercent */
    public $vatPercent;
    
    /**
     * Optional
     * @param string $nameAsString
     * @return $this
     */
    public function setName($nameAsString) {
        $this->name = $nameAsString;
        return $this;
    }
    /** @var string $name */
    public $name;
    
    /**
     * Optional
     * @param string $descriptionAsString
     * @return $this
     */
    public function setDescription($descriptionAsString) {
        $this->description = $descriptionAsString;
        return $this;
    }
    /** @var string $description */
    public $description;
    
    /**
     * Optional
     * @param int $discountPercentAsInteger
     * @return $this
     */
    public function setDiscountPercent($discountPercentAsInteger) {
        $this->discountPercent = $discountPercentAsInteger;
        return $this;
    }
    /** @var int $discountPercent */
    public $discountPercent;    

    /** @var int  contains int 0 if not set. */
    public $vatDiscount = 0;    
}
