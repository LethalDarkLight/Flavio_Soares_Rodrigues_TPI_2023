<?php

class Image
{
    /**
     * @var int $id L'identifiant unique de l'image
     */
    public $id;

    /**
     * @var string $content Le contenu de l'image (en base64, par exemple)
     */
    public $content;

    /**
     * @var string $name Le nom de l'image
     */
    public $name;

    /**
     * @var string $type Le type de l'image (par exemple, "jpeg" ou "png")
     */
    public $type;

    /**
     * @var bool $mainImage Indique si l'image est principale pour un article
     */
    public $mainImage;

    /**
     * @var int $articleID L'identifiant de l'article associé à l'image
     */
    public $articleId;

    /**
     * Constructeur appelé lors de la création de l'objet.
     *
     * @param int $idParam L'identifiant unique de l'image (optionnel, -1 par défaut)
     * @param string $contentParam Le contenu de l'image
     * @param string $nameParam Le nom de l'image
     * @param string $typeParam Le type de l'image
     * @param bool $mainImageParam Indique si l'image est principale pour un article
     * @param int $articleIDParam L'identifiant de l'article associé à l'image
     */
    public function __construct($idParam = -1, $contentParam = "", $nameParam = "", $typeParam = "", $mainImageParam = "", $articleIdParam = "")
    {
        $this->id = $idParam;
        $this->content = $contentParam;
        $this->name = $nameParam;
        $this->type = $typeParam;
        $this->mainImage = $mainImageParam;
        $this->articleId = $articleIdParam;
    }
}