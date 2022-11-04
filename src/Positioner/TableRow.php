<?php
/**
 * @package dompdf-arabic
 * @link    https://github.com/laratweaks/dompdf-arabic
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
namespace DompdfArabic\Positioner;

use DompdfArabic\FrameDecorator\AbstractFrameDecorator;

/**
 * Positions table rows
 *
 * @package dompdf-arabic
 */
class TableRow extends AbstractPositioner
{

    /**
     * @param AbstractFrameDecorator $frame
     */
    function position(AbstractFrameDecorator $frame): void
    {
        $cb = $frame->get_containing_block();
        $p = $frame->get_prev_sibling();

        if ($p) {
            $y = $p->get_position("y") + $p->get_margin_height();
        } else {
            $y = $cb["y"];
        }
        $frame->set_position($cb["x"], $y);
    }
}
