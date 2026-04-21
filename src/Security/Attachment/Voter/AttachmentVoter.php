<?php

declare(strict_types=1);

namespace App\Attaching\Security\Attachment\Voter;

use App\Attaching\Entity\Attachment\Attachment;
use App\Attaching\Enum\Attachment\AttachmentStatus;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Vote;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * @extends Voter<string, Attachment>
 */
final class AttachmentVoter extends Voter
{
    public const string VIEW = 'ATTACHMENT_VIEW';
    public const string DOWNLOAD = 'ATTACHMENT_DOWNLOAD';
    public const string DELETE = 'ATTACHMENT_DELETE';
    public const string ATTACH = 'ATTACHMENT_ATTACH';
    public const string DETACH = 'ATTACHMENT_DETACH';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $subject instanceof Attachment && \in_array($attribute, [
            self::VIEW,
            self::DOWNLOAD,
            self::DELETE,
            self::ATTACH,
            self::DETACH,
        ], true);
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token, ?Vote $vote = null): bool
    {
        if (AttachmentStatus::Deleted === $subject->getStatus()) {
            return false;
        }

        return true;
    }
}
