<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\Symfony\Contracts\Translation;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 */
interface TranslatableInterface
{
    public function trans(TranslatorInterface $translator, ?string $locale = null): string;
}
