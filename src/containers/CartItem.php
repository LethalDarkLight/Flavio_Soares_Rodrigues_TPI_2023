<?php

class CartItem
{
    /**
     * @var int $usersId L'identifiant unique de l'utilisateur
     */
    public $usersId;

    /**
     * @var int $articlesId L'identifiant unique de l'article
     */
    public $articlesId;

    /**
     * @var int $quantity La quantité d'articles
     */
    public $quantity;

    /**
     * Constructeur appelé lors de la création de l'objet.
     *
     * @param int $usersIdParam L'identifiant unique de l'utilisateur
     * @param int $articlesIdParam L'identifiant unique de l'article
     * @param int $quantityParam La quantité d'articles
     */
    public function __construct($usersIdParam, $articlesIdParam, $quantityParam)
    {
        $this->usersId = $usersIdParam;
        $this->articlesId = $articlesIdParam;
        $this->quantity = $quantityParam;
    }
}