import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import Input from '../utils/Input';
import TextArea from '../utils/TextArea';
import Button from '../utils/Button';

class Activity extends Component {
    constructor(props) {
        super(props);
        this.state = {
            newUser: {
                activity_name: "",
                activity_start_time: "",
                activity_end_time: "",
                prof_of_output: "",
                status: ""
            }
        }
    
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleChange(event) {
        this.setState({value: event.target.newUser});
      }
    
    handleSubmit(event) {
        alert('A name was submitted: ' + this.state.newUser);
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
                                <form>
                                <Input
                                    inputType={"text"}
                                    title={"Title"}
                                    name={"activity_name"}
                                    placeholder={"Enter your title"}
                                    onChange={this.handleChange}
                                />
                                <Input
                                    inputType={"text"}
                                    title={"Start Time"}
                                    name={"activity_start_time"}
                                    placeholder={"Start Time"}
                                    onChange={this.handleChange}
                                />
                                <Input
                                    inputType={"text"}
                                    title={"End Time"}
                                    name={"activity_start_time"}
                                    placeholder={"End Time"}
                                    onChange={this.handleChange}
           
                                />
                                <Input
                                    inputType={"file"}
                                    title={"Prof of Output"}
                                    name={"prof_of_output"}
                                    onChange={this.handleChange}
                                />
                                <TextArea
                                    rows={10}
                                    name={"prof_of_output"}
                                    handleChange={this.handleTextArea}
                                    placeholder={"If no file to be upload"}
                                    onChange={this.handleChange}
                                />
                                <Button
                                    action={this.handleClearForm}
                                    type={"primary"}
                                    title={"Save"}
                                />
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