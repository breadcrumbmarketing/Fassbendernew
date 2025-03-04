<?php
/**
 * Class QRGdImagePNG
 *
 * @created      25.10.2023
 * @author       smiley <smiley@chillerlan.net>
 * @copyright    2023 smiley
 * @license      MIT
 *
 * @noinspection PhpComposerExtensionStubsInspection
 *
 * Modified by MarketPress GmbH on 16-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace MarketPress\German_Market\chillerlan\QRCode\Output;

use function imagepng, max, min;

/**
 * GdImage png output
 *
 * @see \imagepng()
 */
class QRGdImagePNG extends QRGdImage{

	public const MIME_TYPE = 'image/png';

	/**
	 * @inheritDoc
	 */
	protected function renderImage():void{
		imagepng($this->image, null, max(-1, min(9, $this->options->quality)));
	}

}
