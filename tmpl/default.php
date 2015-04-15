<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_custom
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$speed = (!is_null($params->get('moduletime_speed'))) ? $params->get('moduletime_speed') : '1000';
$theme = (!is_null($params->get('theme'))) ? $params->get('theme') : 'blue';

?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="<?php echo JURI::base() . 'modules/mod_pgcounter/js/jquery.pgcounter.js'; ?>"></script>
<link rel="stylesheet" href="<?php echo JURI::base() . 'modules/mod_pgcounter/css/pgcounter.css'; ?>" type="text/css" />

<div class="counter<?php echo $moduleclass_sfx ?>">
    <div id="clock" class="clock"></div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
       jQuery('#clock').pgcounter({
           value: '<?php echo $countObj->value; ?>',
           theme:'<?php echo $theme;?>', 
           time:'<?php echo $speed;?>'
       });
    });
</script>