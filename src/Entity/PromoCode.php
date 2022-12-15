<?php

declare(strict_types=1);

namespace App\Entity;

use App\DB\DatabaseConnector;
use DateTime;

class PromoCode extends Entity
{
    protected const TABLE_NAME = 'promo_code';

    private int $id;
    private string $code;
    private ?DateTime $issueDate = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getIssueDate(): ?DateTime
    {
        return $this->issueDate;
    }

    public function setIssueDate(?DateTime $issueDate): self
    {
        $this->issueDate = $issueDate;

        return $this;
    }

    public static function getFreePromoCode(): ?PromoCode
    {
        /** @var DatabaseConnector $dbConnector */
        $dbConnector = DatabaseConnector::getInstance();

        return $dbConnector->executeWithConversionToClass(
            static::class,
            "SELECT * FROM " . static::TABLE_NAME . " WHERE issue_date IS NULL ORDER BY ID LIMIT 1"
        );
    }
}
