import React from 'react'
import { Wrapper } from './styles'
import { Form, Field } from 'react-final-form'

const sleep = ms => new Promise(resolve => setTimeout(resolve, ms))

const onSubmit = async values => {
  await sleep(1500)
  window.alert(JSON.stringify(values, 0, 2))
}

const SignIn = () => {
    return(
        <Wrapper>
            <Form
                onSubmit={onSubmit}
                // initialValues={{ login: 'larry', employed: false }}
                render={({ handleSubmit, form, submitting, pristine, values }) => (
                    <form onSubmit={handleSubmit}>
                        <div className="fieldWrapper">
                            <label>Username</label>
                            <Field
                                name="SignIn"
                                component="input"
                                type="text"
                                placeholder="Sign In"
                            />
                        </div>
                        <div className="fieldWrapper">
                            <label>Password</label>
                            <Field
                                name="SignInPassword"
                                component="input"
                                type="text"
                                placeholder="Password"
                            />
                        </div>            
                        <div className="fieldWrapper">
                            <label>Confirm Password</label>
                            <Field
                                name="ConfirmPassword"
                                component="input"
                                type="text"
                                placeholder="Confirm Password"
                            />
                        </div>       
                        <div className="buttons">
                            <button type="submit" disabled={submitting || pristine}>
                                Submit
                            </button>
                            <button
                                type="button"
                                onClick={form.reset}
                                disabled={submitting || pristine}
                            >
                                Reset
                            </button>
                        </div>
                        <pre>{JSON.stringify(values, 0, 2)}</pre>
                    </form>
                )}
            />
        </Wrapper>
    )
}

export { SignIn } 
