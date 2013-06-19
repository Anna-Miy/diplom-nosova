<?php
class VarDumper extends CVarDumper {

	/**
	 * Displays a variable.
	 * This method achieves the similar functionality as var_dump and print_r
	 * but is more robust when handling complex objects such as Yii controllers.
	 * @param $var
	 * @param int $depth
	 * @param bool $highlight
	 *
	 * @internal param \variable $mixed to be dumped
	 *
	 * @internal param \maximum $integer depth that the dumper should go into the variable. Defaults to 10.
	 *
	 * @internal param \whether $boolean the result should be syntax-highlighted
	 */
    public static function dump($var,$depth=10,$highlight=true){
        echo self::dumpAsString($var,$depth,$highlight);
    }
}