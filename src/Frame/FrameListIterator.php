<?php
/**
 * @package dompdf-arabic
 * @link    https://github.com/laratweaks/dompdf-arabic
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
namespace DompdfArabic\Frame;

use Iterator;
use DompdfArabic\Frame;

/**
 * Linked-list Iterator
 *
 * Returns children in order and allows for the list to change during iteration,
 * provided the changes occur to or after the current element.
 *
 * @package dompdf-arabic
 */
class FrameListIterator implements Iterator
{
    /**
     * @var Frame
     */
    protected $parent;

    /**
     * @var Frame|null
     */
    protected $cur;

    /**
     * @var Frame|null
     */
    protected $prev;

    /**
     * @var int
     */
    protected $num;

    /**
     * @param Frame $frame
     */
    public function __construct(Frame $frame)
    {
        $this->parent = $frame;
        $this->rewind();
    }

    public function rewind(): void
    {
        $this->cur = $this->parent->get_first_child();
        $this->prev = null;
        $this->num = 0;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return $this->cur !== null;
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return $this->num;
    }

    /**
     * @return Frame|null
     */
    public function current(): ?Frame
    {
        return $this->cur;
    }

    public function next(): void
    {
        if ($this->cur === null) {
            return;
        }

        if ($this->cur->get_parent() === $this->parent) {
            $this->prev = $this->cur;
            $this->cur = $this->cur->get_next_sibling();
            $this->num++;
        } else {
            // Continue from the previous child if the current frame has been
            // moved to another parent
            $this->cur = $this->prev !== null
                ? $this->prev->get_next_sibling()
                : $this->parent->get_first_child();
        }
    }
}
