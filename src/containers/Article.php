<?php

class Article
{
    /**
     * @var int $id L'identifiant unique de l'article
     */
    public $id;

    /**
     * @var string $name Le nom de l'article
     */
    public $name;

    /**
     * @var string $description La description de l'article
     */
    public $description;

    /**
     * @var double $price Le prix de l'article
     */
    public $price;

    /**
     * @var int $stock La quantité en stock de l'article
     */
    public $stock;

    /**
     * @var bool $featured Indique si l'article est mis en avant
     */
    public $featured;

    /**
     * @var string $creationDate La date de création de l'article au format YYYY-MM-DD
     */
    public $creationDate;

    /**
     * @var string $updateDate La date de dernière mise à jour de l'article au format YYYY-MM-DD
     */
    public $updateDate;

    /**
     * @var int $categoryId L'identifiant de la catégorie à laquelle l'article appartient
     */
    public $categoryId;

    /**
     * Constructeur appelé lors de la création de l'objet.
     *
     * @param int $idParam L'identifiant unique de l'article (optionnel, -1 par défaut)
     * @param string $nameParam Le nom de l'article
     * @param string $descriptionParam La description de l'article
     * @param float $priceParam Le prix de l'article
     * @param int $stockParam La quantité en stock de l'article
     * @param bool $featuredParam Indique si l'article est mis en avant (optionnel, false par défaut)
     * @param string $creationDateParam La date de création de l'article au format YYYY-MM-DD
     * @param string $updateDateParam La date de dernière mise à jour de l'article au format YYYY-MM-DD
     * @param int $categoryIdParam L'identifiant de la catégorie à laquelle l'article appartient
     */
    public function __construct($idParam = -1, $nameParam, $descriptionParam, $priceParam, $stockParam, $featuredParam = false, $creationDateParam, $updateDateParam = null, $categoryIdParam)
    {
        $this->id = $idParam;
        $this->name = $nameParam;
        $this->description = $descriptionParam;
        $this->price = $priceParam;
        $this->stock = $stockParam;
        $this->featured = $featuredParam;
        $this->creationDate = $creationDateParam;
        $this->updateDate = $updateDateParam;
        $this->categoryId = $categoryIdParam; 
    }
}