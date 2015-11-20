import { extend } from 'flarum/extend';
import app from 'flarum/app';

import CacheSettingsModal from 'hyn/cache/components/CacheSettingsModal';

app.initializers.add('hyn-cache', app => {
    app.extensionSettings['hyn-cache'] = () => app.modal.show(new CacheSettingsModal());
});