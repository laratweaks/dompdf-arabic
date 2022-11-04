<?php
/**
 * @package dompdf-arabic
 * @link    https://github.com/laratweaks/dompdf-arabic
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
namespace DompdfArabic\Renderer;

use DompdfArabic\Frame;

/**
 * Renders block frames
 *
 * @package dompdf-arabic
 */
class TableRowGroup extends Block
{

    /**
     * @param Frame $frame
     */
    function render(Frame $frame)
    {
        $style = $frame->get_style();

        $this->_set_opacity($frame->get_opacity($style->opacity));

        $border_box = $frame->get_border_box();

        $this->_render_border($frame, $border_box);
        $this->_render_outline($frame, $border_box);

        $id = $frame->get_node()->getAttribute("id");
        if (strlen($id) > 0) {
            $this->_canvas->add_named_dest($id);
        }

        $this->debugBlockLayout($frame, "red");
    }
}
