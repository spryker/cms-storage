<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Category\Communication\Controller;

use Generated\Shared\Transfer\NodeTransfer;
use Spryker\Zed\Application\Communication\Controller\AbstractController;
use Spryker\Zed\Category\Business\Exception\CategoryUrlExistsException;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\Category\Business\CategoryFacade getFacade()
 * @method \Spryker\Zed\Category\Communication\CategoryCommunicationFactory getFactory()
 * @method \Spryker\Zed\Category\Persistence\CategoryQueryContainer getQueryContainer()
 */
class EditController extends AbstractController
{

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(Request $request)
    {
        $form = $this->getFactory()->createCategoryEditForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $categoryTransfer = $this->getCategoryTransferFromForm($form);
            try {
                $this->getFacade()->updateCategory($categoryTransfer);
                $categoryNodeTransfer = $categoryTransfer->getCategoryNode();
                $categoryNodeTransfer->setFkCategory($categoryTransfer->getIdCategory());
                $categoryNodeTransfer->setFkParentCategoryNode($categoryTransfer->getParentCategoryNode()->getIdCategoryNode());
                $categoryNodeTransfer->setLocalizedAttributes($categoryTransfer->getLocalizedAttributes());
                $this->getFacade()->updateCategoryNode($categoryNodeTransfer);

                $this->addSuccessMessage('The category was updated successfully.');

                return $this->redirectResponse('/category/edit?id-category=' . $categoryTransfer->getIdCategory());
            } catch (CategoryUrlExistsException $e) {
                $this->addErrorMessage($e->getMessage());
            }
        }

        return $this->viewResponse([
            'categoryForm' => $form->createView(),
            'currentLocale' => $this->getFactory()->getCurrentLocale()->getLocaleName(),
        ]);
    }

    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return \Generated\Shared\Transfer\CategoryTransfer
     */
    protected function getCategoryTransferFromForm(FormInterface $form)
    {
        return $form->getData();
    }
}
