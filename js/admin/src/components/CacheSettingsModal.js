import SettingsModal from 'flarum/components/SettingsModal';

export default class CacheSettingsModal extends SettingsModal {
    className() {
        return 'CacheSettingsModal Modal--small';
    }

    title() {
        return 'Cache Settings';
    }

    form() {
        return [
            <div className="Form-group">
                <label>Cache driver</label>
                <select bidi={this.setting('hyn.analytics.google')}>
                    <option value="redis">Redis</option>
                </select>
            </div>
        ];
    }
}