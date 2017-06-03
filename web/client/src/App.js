import React, {Component} from 'react';
import './App.css';

const URL = 'http://syzygy-happiness.herokuapp.com';

const UNDEFINED = 'undefined';
const HAPPY = 'happy';
const NEUTRAL = 'neutral';
const SAD = 'sad';

class App extends Component {
    constructor() {
        super();

        this.state = {
            happinessLevel: UNDEFINED
        };
    }

    render() {
        const happyClass = this.state.happinessLevel === HAPPY ? 'button--active' : '';
        const neutralClass = this.state.happinessLevel === NEUTRAL ? 'button--active' : '';
        const sadClass = this.state.happinessLevel === SAD ? 'button--active' : '';
        return (
            <div className={`app`}>
                <div className={`button button--happy ${happyClass}`} onClick={() => this.setHappinessLevel(HAPPY)}> :-)</div>
                <div className={`button button--neutral ${neutralClass}`} onClick={() => this.setHappinessLevel(NEUTRAL)}>:-|</div>
                <div className={`button button--sad ${sadClass}`} onClick={() => this.setHappinessLevel(SAD)}>:-(</div>
            </div>
        );
    }

    setHappinessLevel(level) {
        this.setState({happinessLevel: level});

        setTimeout(() => this.setState({happinessLevel: UNDEFINED}), 500);

        fetch(URL + '/happiness_levels', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                level: level
            })
        });
    }
}

export default App;
