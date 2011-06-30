<?php

/*
 * This file is part of the Badwords PHP package.
 *
 * (c) Stephen Melrose <me@stephenmelrose.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Badword\Filter\Config\Rule;

use Badword\Filter\Config\Rule;
use Badword\Word;

/**
 * MustStartEndWord defines the detection Rule for whether a 
 * Word must exist at the start and/or end of a word only.
 *
 * @author Stephen Melrose <me@stephenmelrose.co.uk>
 */
class MustStartEndWord implements Rule
{
    const REGEXP = '[^a-z0-9]';
    
    /**
     * {@inheritdoc}
     */
    public function apply($regExp, Word $word)
    {
        // Group the regular expression (used later in the filter)
        $regExp = '(' . $regExp . ')';
        
        // If the Word must exist at the start of a word only, add word boundary detection
        if($word->getMustStartWord())
        {
            $regExp = '(?:^|' . static::REGEXP . ')' . $regExp;
        }
        
        // If the Word must exist at the end of a word only, add word boundary detection
        if($word->getMustEndWord())
        {
            $regExp .= '(?:$|' . static::REGEXP . ')';
        }
        
        return $regExp;
    }
}