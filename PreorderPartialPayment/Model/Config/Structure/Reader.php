<?php 

namespace Emizentech\PreorderPartialPayment\Model\Config\Structure;

use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\TemplateEngine\Xhtml\CompilerInterface;

class Reader extends \Magento\Config\Model\Config\Structure\Reader
{
	public function __construct(
		\Magento\Framework\Config\FileResolverInterface $fileResolver,
		\Magento\Config\Model\Config\Structure\Converter $converter,
		\Magento\Config\Model\Config\SchemaLocator $schemaLocator,
		\Magento\Framework\Config\ValidationStateInterface $validationState,
		\Magento\Framework\View\TemplateEngine\Xhtml\CompilerInterface $compiler,
		$filename = 'preorder.xml',
		$idAttributes = [],
		$domDocumentClass = 'Magento\Framework\Config\Dom',
		$defaultScope = 'global'
	){
		parent::__construct($fileResolver, $converter, $schemaLocator, $validationState, $compiler, $filename, $idAttributes, $domDocumentClass, $defaultScope);
	}
}