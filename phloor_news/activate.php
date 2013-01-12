<?php

if (get_subtype_id('object', 'phloor_news')) {
	update_subtype('object', 'phloor_news', 'PhloorNews');
} else {
	add_subtype('object', 'phloor_news', 'PhloorNews');
}
