<?php
/**
 * @package dompdf-arabic
 * @link    https://github.com/laratweaks/dompdf-arabic
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
namespace DompdfArabic\Positioner;

use DompdfArabic\FrameDecorator\AbstractFrameDecorator;

/**
 * Positions block frames
 *
 * @package dompdf-arabic
 */
class Block extends AbstractPositioner
{

    function position(AbstractFrameDecorator $frame): void
    {
        $style = $frame->get_style();
        $cb = $frame->get_containing_block();
        $p = $frame->find_block_parent();

        if ($p) {
            $float = $style->float;

            if (!$float || $float === "none") {
                $p->add_line(true);
            }
            $y = $p->get_current_line_box()->y;
        } else {
            $y = $cb["y"];
        }

        $x = $cb["x"];

        $frame->set_position($x, $y);
    }
}
