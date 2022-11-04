<?php
/**
 * @package dompdf-arabic
 * @link    https://github.com/laratweaks/dompdf-arabic
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
namespace DompdfArabic;

/**
 * Embeds Javascript into the PDF document
 *
 * @package dompdf-arabic
 */
class JavascriptEmbedder
{

    /**
     * @var Dompdf
     */
    protected $_dompdf;

    /**
     * JavascriptEmbedder constructor.
     *
     * @param Dompdf $dompdf
     */
    public function __construct(Dompdf $dompdf)
    {
        $this->_dompdf = $dompdf;
    }

    /**
     * @param $script
     */
    public function insert($script)
    {
        $this->_dompdf->getCanvas()->javascript($script);
    }

    /**
     * @param Frame $frame
     */
    public function render(Frame $frame)
    {
        if (!$this->_dompdf->getOptions()->getIsJavascriptEnabled()) {
            return;
        }

        $this->insert($frame->get_node()->nodeValue);
    }
}
