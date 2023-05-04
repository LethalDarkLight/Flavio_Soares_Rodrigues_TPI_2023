<?php

class Category
{
    /**
     * @var int $id L'identifiant unique de la catégorie
     */
    public $id;

    /**
     * @var string $name Le nom de la catégorie
     */
    public $name;

    /**
     * Constructeur appelé lors de la création de l'objet.
     *
     * @param int $idParam L'identifiant unique de la catégorie (optionnel, -1 par défaut)
     * @param string $nameParam Le nom de la catégorie
     */
    public function __construct($idParam = -1, $nameParam)
    {
        $this->id = $idParam;
        $this->name = $nameParam;
    }
}