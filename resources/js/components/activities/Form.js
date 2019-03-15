import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

import Input from '../utils/Input';
import TextArea from '../utils/TextArea';
import Button from '../utils/Button';

class Activity extends Component {
    constructor(props) {
        super(props);
        this.state = {title: '', description: ''};
    
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleChange(key) {
        return function (e) {
          var state = {};
          state[key] = e.target.value;
          this.setState(state);
        }.bind(this);
        
    }
      
     handleSubmit(event) {
        const { history } = this.props
        
        var data = {
                title: this.state.title,
                description: this.state.description,
        }
        alert('Hello ' + data.title + ', your message is: ' + data.description);

        axios.post('/productivity_tracker/api/tasks', { data })
        .then(res => {
            console.log(res);
            console.log(res.data);
        })


        
        /* POST DATAS TO PHP HERE...
          var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", "form/form-submit.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
             xmlhttp.send(data);
        */
    
        event.preventDefault();
    }


    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-header"><h3>Add Activity</h3></div>
                            <div className="card-body">
                                <form onSubmit={this.handleSubmit}>
                                    <label>
                                        Title:
                                        <input type="text" value={this.state.title} onChange={this.handleChange('title')} />
                                    </label>
                                    <label>
                                        Description:
                                        <input type="text" value={this.state.description} onChange={this.handleChange('description')} />
                                    </label>
                                    <input type="submit" value="Submit" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            );
        }
    }

    const timeStyle = {
        margin: "10px 10px 10px 10px"
    };

export default Activity;