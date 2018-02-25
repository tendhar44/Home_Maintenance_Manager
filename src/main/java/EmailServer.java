import java.util.Scanner;

import org.apache.commons.mail.*;

public class EmailServer {
	
	private final static String username = "joe.m723378@gmail.com";
	private final static String password = "islandconstitutionsubjective";
	private final static String hostName = "smtp.gmail.com";
	private final static int smtpPort = 465;
	private final static String from = "joe.m723378@gmail.com";
	

	public EmailServer() {
		
	}

	public boolean send(ReminderEmail reminderEmail) {
		
		try {
			Email email = new SimpleEmail();
			email.setHostName(hostName);
			email.setSmtpPort(smtpPort);
			email.setAuthenticator(new DefaultAuthenticator(username, password));
			email.setSSLOnConnect(true);
			email.setFrom(from);
			email.setSubject(reminderEmail.getSubject());
			email.setMsg(reminderEmail.getText());
			email.addTo(reminderEmail.getTo());
			email.send();
		} catch (EmailException ee) {
			System.out.println(ee);
			return false;
		}

		return true;
	}

}
