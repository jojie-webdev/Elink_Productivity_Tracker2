import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import Activity from './activities';

export default class Main extends Component {
    render() {
        return (
            <div>
                <Activity />
            </div>
        );
    }
}

if (document.getElementById('project')) {
    ReactDOM.render(<Main />, document.getElementById('project'));
}
