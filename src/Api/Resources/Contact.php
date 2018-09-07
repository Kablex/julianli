<?php
declare(strict_types=1);

namespace App\Api\Resources;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *      collectionOperations={
 *          "post"={
 *              "path"="/contact",
 *          },
 *      },
 *      itemOperations={},
 * )
 */
class Contact
{
    /**
     * @Assert\NotNull(message="How can I call you?")
     */
    public $name;

    /**
     * @Assert\NotNull(message="I could not contact you without an email address.")
     * @Assert\Email(message="I could not contact you through an invalid email address.")
     */
    public $email;

    /**
     * @Assert\NotNull(message="Can you specify the subject?")
     */
    public $subject;

    /**
     * @Assert\NotNull(message="Tell me something please.")
     */
    public $message;
}
