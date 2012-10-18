<?php
 
class Patches_ClearCart_Model_Observer_Cart {


    /**
     * Retrieve shopping cart model object
     *
     * @return Mage_Checkout_Model_Cart
     */	
	    protected function _getCart()
    {
        return Mage::getSingleton('checkout/cart');
    }

    /**
     * Get checkout session model instance
     *
     * @return Mage_Checkout_Model_Session
     */	
	    protected function _getSession()
    {
        return Mage::getSingleton('checkout/session');
    }
  /**
   * Empty Cart, after succesful order
   *
   * @param Varien_Event_Observer $observer
   */
  public function clearCart(Varien_Event_Observer $observer) {


       try {
            $this->_getCart()->truncate()->save();
            $this->_getSession()->setCartWasUpdated(true);
        } catch (Mage_Core_Exception $exception) {
            $this->_getSession()->addError($exception->getMessage());
        } catch (Exception $exception) {
            $this->_getSession()->addException($exception, $this->__('Cannot update shopping cart.'));
        }
	

  }
}
