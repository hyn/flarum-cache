import SettingsModal from 'flarum/components/SettingsModal';

export default class CacheSettingsModal extends SettingsModal {
    className() {
        return 'CacheSettingsModal Modal--large';
    }

    title() {
        return 'Cache Settings';
    }

    form() {
        return [
            <div className="Form-group">
                <label>Cache driver</label>
                <select bidi={this.setting('hyn.cache.driver')}>
                    <option value="apc">APC</option>
                    <option value="array">array (no cache)</option>
                    <option value="database">Database</option>
                    <option value="file">File (Flarum default)</option>
                    <option value="memcached" disabled>Memcached</option>
                    <option value="redis">Redis</option>
                </select>
            </div>,
            <div className="Form-group">
                <label>Server settings</label>

            </div>
        ];
    }
}