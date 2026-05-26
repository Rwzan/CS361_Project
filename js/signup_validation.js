// signup_validation.js - client-side validation for signup form
function validateSignupForm(e) {
  e.preventDefault();

  const form = document.getElementById('signupForm');
  const name = form.name.value.trim();
  const email = form.email.value.trim();
  const password = form.password.value;
  const role = form.role.value;
  const city = form.city.value.trim();

  let messages = [];

  if (name.length < 3) {
    messages.push('Name must be at least 3 characters.');
  }

  if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)) {
    messages.push('Enter a valid email address.');
  }

  if (password.length < 8) {
    messages.push('Password must be at least 8 characters.');
  }

  if (!/\d/.test(password)) {
    messages.push('Password must include at least one number.');
  }

  if (!(role === 'student' || role === 'tutor')) {
    messages.push('Select a role (student or tutor).');
  }

  if (city.length === 0) {
    messages.push('City is required.');
  }

  if (messages.length) {
    alert('Please fix the following:\n- ' + messages.join('\n- '));
    return false;
  }

  // submit
  form.submit();
  return true;
}
