<?php
/**
 * (c) Spryker Systems GmbH copyright protected
 */
namespace Spryker\Zed\Wishlist\Business;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\WishlistChangeTransfer;
use Generated\Shared\Transfer\WishlistTransfer;

/**
 * @method WishlistDependencyContainer getDependencyContainer()
 */
interface WishlistFacadeInterface
{

    /**
     * @param WishlistChangeTransfer $wishlistChange
     *
     * @return WishlistTransfer
     */
    public function addItem(WishlistChangeTransfer $wishlistChange);

    /**
     * @param WishlistChangeTransfer $wishlistChange
     *
     * @return WishlistTransfer
     */
    public function removeItem(WishlistChangeTransfer $wishlistChange);

    /**
     * @param WishlistChangeTransfer $wishlistChange
     *
     * @return WishlistTransfer
     */
    public function decreaseQuantity(WishlistChangeTransfer $wishlistChange);

    /**
     * @param WishlistChangeTransfer $wishlistChange
     *
     * @return WishlistTransfer
     */
    public function increaseQuantity(WishlistChangeTransfer $wishlistChange);

    /**
     * @param CustomerTransfer $customerTransfer
     *
     * @return WishlistTransfer
     */
    public function getCustomerWishlist(CustomerTransfer $customerTransfer);

}