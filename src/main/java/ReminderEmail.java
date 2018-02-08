public class ReminderEmail {

	//Data field
	private String to;
	private String from;
	private String host;
	private String subject;
	private String text;
	
	/////////////////////////
	/////constructors
	//////////////////////////
	public ReminderEmail() {}		
	public ReminderEmail(String to, String from, String host, String subject) {
		super();
		this.to = to;
		this.from = from;
		this.host = host;
		this.subject = subject;
	}
	public ReminderEmail(String to, String from, String host, String subject, String text) {
		this.to = to;
		this.from = from;
		this.host = host;
		this.subject = subject;
		this.text = text;
	}


	public String getTo() {
		return to;
	}
	public void setTo(String to) {
		this.to = to;
	}
	public String getFrom() {
		return from;
	}
	public void setFrom(String from) {
		this.from = from;
	}
	public String getHost() {
		return host;
	}
	public void setHost(String host) {
		this.host = host;
	}
	public String getSubject() {
		return subject;
	}
	public void setSubject(String subject) {
		this.subject = subject;
	}
	public String getText() {
		return text;
	}
	public void setText(String text) {
		this.text = text;
	}

	
	
	
	
	
//	public static void main(String[] args) {

		//////// CODE BELOW IS FROM TUTORIAL POINT, USE IT AS REFERENCE////////////

		// // Recipient's email ID needs to be mentioned.
		// String to = "abcd@gmail.com";
		//
		// // Sender's email ID needs to be mentioned
		// String from = "web@gmail.com";
		//
		// // Assuming you are sending email from localhost
		// String host = "localhost";
		//
		// // Get system properties
		// Properties properties = System.getProperties();
		//
		// // Setup mail server
		// properties.setProperty("mail.smtp.host", host);
		//
		// // Get the default Session object.
		// Session session = Session.getDefaultInstance(properties);
		//
		// try {
		// // Create a default MimeMessage object.
		// MimeMessage message = new MimeMessage(session);
		//
		// // Set From: header field of the header.
		// message.setFrom(new InternetAddress(from));
		//
		// // Set To: header field of the header.
		// message.addRecipient(Message.RecipientType.TO, new InternetAddress(to));
		//
		// // Set Subject: header field
		// message.setSubject("This is the Subject Line!");
		//
		// // Now set the actual message
		// message.setText("This is actual message");
		//
		// // Send message
		// Transport.send(message);
		// System.out.println("Sent message successfully....");
		// } catch (MessagingException mex) {
		// mex.printStackTrace();
		// }

//	}

}